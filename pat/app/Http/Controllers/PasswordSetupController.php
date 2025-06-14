<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Gebruiker;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class PasswordSetupController extends Controller
{
    public function show(Request $request, Gebruiker $user, $password)
{
    // Generate the signed URL for POST (includes signature)
    $postUrl = URL::signedRoute('password.setup.update', ['user' => $user->id]);

    return view('student.password-setup', compact('user', 'password', 'postUrl'));
}

    public function update(Request $request, Gebruiker $user)
    {
        $request->validate([
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        // Update user password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password set successfully!');
    }
}
