<?php

namespace App\Http\Controllers;

use App\Exports\EvaluatieResultatenExport;
use App\Models\Criterium;
use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Groep;
use App\Models\Klas;
use App\Models\Score;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class EvaluatieController extends Controller
{
    public function store(Request $req)
    {
        $validated = $req->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'deadline' => 'required|date',
            'vakId' => 'required|integer|exists:vakken,id',
            'criteria' => 'required|array|min:1',
            'criteria.*.criterium' => 'required|string|max:255',
            'criteria.*.max_waarde' => 'required|numeric',
            'criteria.*.min_waarde' => 'required|numeric',
        ]);

        foreach ($validated['criteria'] as $index => $item) {
            if ($item['min_waarde'] >= $item['max_waarde']) {
                return back()
                    ->withErrors([
                        "criteria.$index.min_waarde" => 'De minimale waarde moet kleiner zijn dan de maximale waarde.',
                    ])
                    ->withInput();
            }
        }

        $evaluatie = Evaluatie::create([
            'titel' => $validated['titel'],
            'beschrijving' => $validated['beschrijving'],
            'deadline' => $validated['deadline'],
            'vak_id' => $validated['vakId']
        ]);
        $evalId = $evaluatie->id;
        foreach ($validated['criteria'] as $criterium) {
            Criterium::create([
                'criterium' => $criterium['criterium'],
                'max_waarde' => $criterium['max_waarde'],
                'min_waarde' => $criterium['min_waarde'],
                'evaluatie_id' => $evalId
            ]);
        }

        return response()->json([
            'msg' => 'success',
            'status' => 201
        ]);
    }

    public function teacherIndex(Request $request)
    {
        $teacher = Gebruiker::find(Auth::user()->id)->first();
        $vakken = $teacher->vakken;
        $vakId = $request->input('vak_id');

        $evaluatiesQuery = \App\Models\Evaluatie::whereIn('vak_id', $vakken->pluck('id'));
        if ($vakId) {
            $evaluatiesQuery->where('vak_id', $vakId);
        }
        $evaluaties = $evaluatiesQuery->with('vak')->get();

        return view('docent.evaluaties', [
            'vakken' => $vakken,
            'evaluaties' => $evaluaties,
        ]);
    }
    public function showGroepen($evaluatieId)
    {
        $evaluatie = \App\Models\Evaluatie::with(['groepen.vak'])->findOrFail($evaluatieId);

        return view('docent.evaluatie-groepen', [
            'evaluatie' => $evaluatie,
        ]);
    }
    public function resultaten($evaluatieId)
    {
        $evaluatie = \App\Models\Evaluatie::with([
            'groepen.studenten',
            'criteria.scores'
        ])->findOrFail($evaluatieId);

        return view('docent.evaluatie-groep', [
            'evaluatie' => $evaluatie,
        ]);
    }
    public function groepResultaten($evaluatieId, $groepId)
    {
        $evaluatie = \App\Models\Evaluatie::with(['criteria.scores'])->findOrFail($evaluatieId);
        $groep = \App\Models\Groep::with('studenten')->findOrFail($groepId);

        return view('docent.evaluatie-groep', [
            'evaluatie' => $evaluatie,
            'groep' => $groep,
        ]);
    }
    public function exportExcel($evaluatieId)
    {
        return Excel::download(new EvaluatieResultatenExport($evaluatieId), 'evaluatie_resultaten.xlsx');
    }
}
