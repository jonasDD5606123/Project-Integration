<?php

namespace App\Http\Controllers;

use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vak;

class VakController extends Controller
{


    public function create()
    {
        $gebruiker = Gebruiker::find(Auth::id());

        // Get vakken linked to user
        $userVakken = $gebruiker ? $gebruiker->vakken()->orderBy('naam')->get() : collect();

        // Get all vakken except those linked to user
        $vakken = Vak::whereNotIn('id', $userVakken->pluck('id'))->orderBy('naam')->get();

        return view('docent.vakken', compact('vakken', 'userVakken'));
    }



    // Store new vak and link logged-in docent
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255|unique:vakken,naam',
        ]);

        $vak = Vak::create(['naam' => $request->naam]);

        $user = Auth::user();
        $vak->docenten()->attach($user->id);

        return redirect()->route('vakken.create')->with('success', 'Vak toegevoegd en gekoppeld aan jou!');
    }

    public function unlink(Request $request)
    {
        $request->validate([
            'vak_id' => 'required|exists:vakken,id',
        ]);

        $user = Auth::user();
        $vakId = $request->vak_id;

        // Detach the docent from the vak
        $gebruiker = Gebruiker::find(Auth::id());

        if ($gebruiker) {
            $gebruiker->vakken()->detach($vakId);
        }


        return redirect()->route('vakken.create')->with('success', 'Je bent succesvol ontkoppeld van het vak.');
    }

    // Link logged-in docent to existing vak
    public function link(Request $request)
    {
        $request->validate([
            'vak_id' => 'required|exists:vakken,id',
        ]);

        $user = Auth::user();
        $vak = Vak::findOrFail($request->vak_id);

        // Prevent duplicate linking
        if ($vak->docenten()->where('docent_id', $user->id)->exists()) {
            return redirect()->route('vakken.create')->with('success', 'Je bent al gekoppeld aan dit vak.');
        }

        $vak->docenten()->attach($user->id);

        return redirect()->route('vakken.create')->with('success', 'Vak succesvol gekoppeld aan jou!');
    }
}
