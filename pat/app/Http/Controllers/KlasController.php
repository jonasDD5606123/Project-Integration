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
    public function manage()
    {
        $userId = Auth::user()->id;

        // Get vakken where the authenticated user is a docent
        $vakken = Vak::whereHas('docenten', function ($query) use ($userId) {
            $query->where('id', $userId);
        })
            ->with('klassen.studenten')
            ->get();

        // Get all gebruikers with role_id = 1 (students)
        $students = Gebruiker::where('rol_id', 1)
            ->get();

        return view('docent.manage-class', compact('vakken', 'students'));
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
