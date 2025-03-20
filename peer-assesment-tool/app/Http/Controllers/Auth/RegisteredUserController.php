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

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'password_confirmation' => ['required', 'same:password'],
        'rol_id' => ['required', 'integer']
    ]);

    $gebruiker = Gebruiker::create([
        'r_nummer' => $request->r_nummer,
        'voornaam' => $request->voornaam,
        'achternaam' => $request->achternaam,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'rol_id' => $request->rol_id
    ]);

    event(new Registered($gebruiker));

    Auth::login($gebruiker);

    return redirect('/');
}

}
