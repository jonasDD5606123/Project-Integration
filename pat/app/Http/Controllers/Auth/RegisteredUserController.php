<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Gebruiker;  // Use the custom model Gebruiker
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Jobs\MailUserPasswordJob;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): \Illuminate\View\View
    {
        return view('docent.create-student');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'r_nummer' => ['required', 'string', 'max:255'],
            'voornaam' => ['required', 'string', 'max:255'],
            'achternaam' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:gebruikers'],
            // No password validation, since password is generated
        ]);

        // Always generate a random password
        $password = Str::random(12);

        $gebruiker = Gebruiker::create([
            'r_nummer' => $request->r_nummer,
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'email' => $request->email,
            'password' => Hash::make($password),
            'rol_id' => 1 // Always set to 1
        ]);

        event(new Registered($gebruiker));

        // Do not log in the user if this is for teacher-adding-student flow

        return redirect('/create-student')->with('success', 'Student succesvol toegevoegd!');
    }

    public function storeAndMail(Request $request): RedirectResponse
    {
        $request->validate([
            'r_nummer' => ['required', 'string', 'max:255'],
            'voornaam' => ['required', 'string', 'max:255'],
            'achternaam' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:gebruikers'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
            // 'rol_id' is not validated, always set to 1
        ]);

        $gebruiker = Gebruiker::create([
            'r_nummer' => $request->r_nummer,
            'voornaam' => $request->voornaam,
            'achternaam' => $request->achternaam,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'rol_id' => 1
        ]);

        // Dispatch the mail job
        dispatch(new MailUserPasswordJob($gebruiker));

        event(new \Illuminate\Auth\Events\Registered($gebruiker));

        return redirect('/create-student'); // Or wherever you want to redirect
    }
}