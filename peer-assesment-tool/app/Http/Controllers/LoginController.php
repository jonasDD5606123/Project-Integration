<?php

namespace App\Http\Controllers;

use App\Http\Requests\InlogRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(InlogRequest $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard'); // Stuur door naar dashboard
        }

        return back()->withErrors([
            'email' => 'Ongeldige inloggegevens.',
            'password' => 'Controleer je wachtwoord en probeer opnieuw.'
        ]);
    }

    public function logout()
    {
        // Log de gebruiker uit
        Auth::logout();

        // Redirect naar de loginpagina met een successtatus
        return redirect('/login')->with('status', 'Je bent succesvol uitgelogd!');
    }
}
