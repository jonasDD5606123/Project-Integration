<?php

namespace App\Http\Controllers;

use App\Models\Klas;
use App\Models\Vak;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KlasController extends Controller
{
    // Show all vakken with klassen and their studenten
    public function manage(Request $request)
    {
        $userId = Auth::user()->id;

        // Get all vakken for this docent
        $vakken = Vak::whereHas('docenten', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->with('klassen.studenten')->get();

        // Select the first vak if none is selected
        $selectedVakId = $request->input('vak_id') ?? $vakken->first()?->id;

        // Get klassen for the selected vak
        $klassen = $vakken->where('id', $selectedVakId)->first()?->klassen ?? collect();

        // Select the first klas if none is selected
        $selectedKlasId = $request->input('klas_id') ?? $klassen->first()?->id;

        // Get students for the selected klas
        $students = $klassen->where('id', $selectedKlasId)->first()?->studenten ?? collect();

        return view('docent.manage-class', compact('vakken', 'klassen', 'students', 'selectedVakId', 'selectedKlasId'));
    }


    // Add student to class
    public function addStudent(Request $request)
    {
        $request->validate([
            'klas_id' => 'required|exists:klassen,id',
            'student_id' => 'required|exists:gebruikers,id',
        ]);

        $klas = Klas::findOrFail($request->klas_id);

        // Avoid duplicate attach
        if (!$klas->studenten()->where('student_id', $request->student_id)->exists()) {
            $klas->studenten()->attach($request->student_id);
        }

        // Redirect back with success message
        return redirect()->route('klas.manage')->with('success', 'Student succesvol toegevoegd aan klas.');
    }
}
