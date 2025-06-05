<?php

namespace App\Http\Controllers;

use App\Models\Criterium;
use App\Models\Evaluatie;
use Illuminate\Http\Request;

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
}
