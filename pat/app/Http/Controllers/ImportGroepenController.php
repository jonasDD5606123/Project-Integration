<?php

namespace App\Http\Controllers;

use App\Models\Groep;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportGroepenController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        $changedGroups = $data['groepen'] ?? [];
        $vakId = $data['vakId'] ?? null;
        $evaluatieId = $data['evaluatieId'] ?? null;
        $deleted = $data['deleted'] ?? [];
        $deletedStudents = $data['deletedStudents'] ?? [];

        if (!$vakId || !$evaluatieId) {
            return response()->json(['error' => 'Ongeldige data'], 422);
        }

        DB::beginTransaction();
        try {
            // Verwijder alleen de groepen die in deleted[] staan
            if (!empty($deleted)) {
                $teVerwijderenGroepen = Groep::whereIn('id', $deleted)
                    ->where('vak_id', $vakId)
                    ->where('evaluatie_id', $evaluatieId)
                    ->get();

                foreach ($teVerwijderenGroepen as $groep) {
                    $groep->studenten()->detach();
                    $groep->delete();
                }
            }

            // Update of maak alleen de groepen die in changedGroups zitten
            foreach ($changedGroups as $group) {
                // Sla alleen groepen op die niet in deleted zitten en die daadwerkelijk gewijzigd zijn
                if (isset($group['groupId']) && in_array($group['groupId'], $deleted)) {
                    continue;
                }
                // Sla alleen op als er een naam en studenten zijn (geen null updates)
                if (empty($group['groupName']) || !isset($group['students'])) {
                    continue;
                }
                $studentIds = Gebruiker::whereIn('r_nummer', $group['students'])->pluck('id')->toArray();

                $groep = Groep::updateOrCreate(
                    [
                        'id' => $group['groupId'] ?? null,
                        'vak_id' => $vakId,
                        'evaluatie_id' => $evaluatieId,
                    ],
                    [
                        'naam' => $group['groupName'],
                    ]
                );
                if (!empty($studentIds)) {
                    $groep->studenten()->sync($studentIds);
                }
            }

            // Verwijder studenten die verwijderd zijn uit de groepen
            if (!empty($deletedStudents)) {
                foreach ($deletedStudents as $item) {
                    if (!empty($item['groupId']) && !empty($item['studentId'])) {
                        $groep = Groep::where('id', $item['groupId'])
                            ->where('vak_id', $vakId)
                            ->where('evaluatie_id', $evaluatieId)
                            ->first();
                        if ($groep) {
                            $gebruiker = Gebruiker::where('r_nummer', $item['studentId'])->first();
                            if ($gebruiker) {
                                $groep->studenten()->detach($gebruiker->id);
                            }
                        }
                    }
                }
            }

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function importStudentGroups(Request $request)
    {
        $groups = $request->input('groups', []);
        $vakId = $request->input('vakId');
        $evaluatieId = $request->input('evaluatieId');

        if (!$vakId || !$evaluatieId || !is_array($groups) || count($groups) === 0) {
            return response()->json(['error' => 'Ongeldige data'], 422);
        }

        DB::beginTransaction();
        try {
            foreach ($groups as $group) {
                $groep = \App\Models\Groep::create([
                    'naam' => $group['groupName'],
                    'vak_id' => $vakId,
                    'evaluatie_id' => $evaluatieId,
                ]);
                // Koppel studenten op basis van user id (r_nummer)
                $studentIds = Gebruiker::whereIn('r_nummer', $group['students'])->pluck('id')->toArray();
                $groep->studenten()->sync($studentIds);
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
