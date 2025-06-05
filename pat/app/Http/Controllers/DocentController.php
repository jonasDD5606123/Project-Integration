<?php

namespace App\Http\Controllers;

use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Klas;
use Illuminate\Http\Request;
use App\Models\Vak; // Import the Vak model
use Illuminate\Support\Facades\Auth;

class DocentController extends Controller
{
    public function groepenImport(Request $request)
    {
        $user = Auth::user();
        $vakken = $user->vakken;
        $klassen = Klas::whereIn('vak_id', $vakken->pluck('id'))->get();

        $selectedVak = $request->query('vak_id');
        $evaluaties = collect();
        if ($selectedVak) {
            $evaluaties = Evaluatie::where('vak_id', $selectedVak)->get();
        } else {
            $evaluaties = Evaluatie::whereIn('vak_id', $vakken->pluck('id'))->get();
        }

        // Example: return to a view
        return view('docent.import-groepen', [
            'vakken' => $vakken,
            'klassen' => $klassen,
            'studenten' => $studenten ?? collect(),
            'evaluaties' => $evaluaties,
            'selectedVak' => $selectedVak,
        ]);
    }

    public function groepenCreate(Request $request)
    {
        $user = Auth::user();
        $vakken = $user->vakken;
        $klassen = Klas::whereIn('vak_id', $vakken->pluck('id'))->get();
        $evaluaties = Evaluatie::whereIn('vak_id', $vakken->pluck('id'))->get();

        $selectedVak = $request->query('vak_id');
        $selectedKlas = $request->query('klas_id');
        $selectedEvaluatie = $request->query('evaluatie_id');

        // Filter studenten op basis van geselecteerde klas of vak
        $studenten = collect();
        if ($selectedKlas) {
            $studenten = \App\Models\Gebruiker::where('rol_id', 1)
                ->whereHas('klassen', function ($query) use ($selectedKlas) {
                    $query->where('klas_id', $selectedKlas);
                })
                ->get();
        } elseif ($selectedVak) {
            $klasIds = $klassen->where('vak_id', $selectedVak)->pluck('id');
            $studenten = \App\Models\Gebruiker::where('rol_id', 1)
                ->whereHas('klassen', function ($query) use ($klasIds) {
                    $query->whereIn('klas_id', $klasIds);
                })
                ->get();
        } else {
            $studenten = \App\Models\Gebruiker::where('rol_id', 1)->get();
        }

        // Haal bestaande groepen op voor de geselecteerde evaluatie
        $groepen = collect();
        if ($selectedEvaluatie) {
            $groepen = \App\Models\Groep::with(['studenten'])
                ->where('evaluatie_id', $selectedEvaluatie)
                ->get();
        }

        return view('docent.create-groepen', [
            'vakken' => $vakken,
            'klassen' => $klassen,
            'studenten' => $studenten,
            'evaluaties' => $evaluaties,
            'selectedVak' => $selectedVak,
            'selectedKlas' => $selectedKlas,
            'selectedEvaluatie' => $selectedEvaluatie,
            'groepen' => $groepen,
        ]);
    }

    public function evaluatieCreate()
    {
        $user = Auth::user();
        $vakken = $user->vakken;

        return view('docent.create-evaluatie', [
            'vakken' => $vakken,
        ]);
    }

    public function evaluatie()
    {
        $user = Auth::user();
        $vakken = $user->vakken;
        $evaluaties = Evaluatie::whereIn('vak_id', $vakken->pluck('id'))->get();

        return view('docent.evaluatie', [
            'vakken' => $vakken,
            'evaluaties' => $evaluaties,
        ]);
    }

    public function klasCreate()
    {
        $user = Auth::user();
        $vakken = $user->vakken;
        $studenten = \App\Models\Gebruiker::where('rol_id', 1)->get();

        return view('docent.create-klas', [
            'vakken' => $vakken,
            'studenten' => $studenten,
        ]);
    }

    public function klasImport()
    {
        $user = Auth::user();
        $vakken = $user->vakken;

        return view('docent.import-klas', [
            'vakken' => $vakken,
        ]);
    }

    public function evaluatieEdit($id)
    {
        $evaluatie = \App\Models\Evaluatie::with('vak', 'criteria')->findOrFail($id);
        $vakken = Auth::user()->vakken;
        return view('docent.edit-evaluatie', [
            'evaluatie' => $evaluatie,
            'vakken' => $vakken,
        ]);
    }
    public function evaluatieUpdate(Request $request, $id)
    {
        $evaluatie = \App\Models\Evaluatie::findOrFail($id);

        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'deadline' => 'required|date',
            'vak_id' => 'required|integer|exists:vakken,id',
            'criteria' => 'array',
            'criteria.*.id' => 'required|integer|exists:criteria,id',
            'criteria.*.criterium' => 'required|string|max:255',
            'criteria.*.min_waarde' => 'required|numeric',
            'criteria.*.max_waarde' => 'required|numeric',
        ]);

        $evaluatie->update($validated);

        // Update each criterium
        if (isset($validated['criteria'])) {
            foreach ($validated['criteria'] as $crit) {
                $criterium = \App\Models\Criterium::find($crit['id']);
                if ($criterium && $criterium->evaluatie_id == $evaluatie->id) {
                    $criterium->update([
                        'criterium' => $crit['criterium'],
                        'min_waarde' => $crit['min_waarde'],
                        'max_waarde' => $crit['max_waarde'],
                    ]);
                }
            }
        }

        return redirect()->route('docent.evaluatie')->with('success', 'Evaluation updated!');
    }
    public function studentenBeheer()
    {
        return view('docent.studenten-beheer');
    }

    public function klasStore(Request $request)
    {
        $validated = $request->validate([
            'naam' => 'required|string|max:255',
            'vak_id' => 'required|integer|exists:vakken,id',
            'studenten' => 'required|array|min:1',
            'studenten.*' => 'integer|exists:gebruikers,id',
        ]);

        $klas = \App\Models\Klas::create([
            'naam' => $validated['naam'],
            'vak_id' => $validated['vak_id'],
        ]);

        $klas->studenten()->sync($validated['studenten']);

        return redirect()->route('docent.studentenbeheer')->with('success', 'Klas created!');
    }
}
