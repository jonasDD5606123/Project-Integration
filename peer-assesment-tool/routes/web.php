<?php

use App\Http\Middleware\DecompressRequest;
use App\Http\Middleware\DocentMiddleware;
use App\Jobs\CreateUserAndAssignToClass;
use App\Jobs\MailUserPasswordJob;
use App\Mail\NewUserMail;
use App\Models\Gebruiker;
use App\Models\Klas;
use App\Models\StudentKlassen;
use Illuminate\Support\Str;

use App\Models\Vak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();
    if ($user->rol_id == 1) {
        return view('student.dashboard');
    } else if ($user->rol_id == 2) {
        return view('docent.dashboard');
    }
})->middleware(middleware: ['auth', 'verified'])->name('dashboard');

Route::get('/import', function () {
    return view('docent.import-students');
})->middleware(['auth', DocentMiddleware::class])->name('import');


Route::get('/create-evaluatie', function () {
    $userId = Auth::id();

    $vakken = Vak::whereIn('id', function ($query) use ($userId) {
        $query->select('vak_id')
            ->from('docenten_vakken')
            ->where('docent_id', $userId);
    })->get();

    return view('docent.create-evaluatie', compact('vakken'));
})->middleware(['auth', DocentMiddleware::class])->name('create-evaluatie');

Route::get('/create-klas', function () {
    $userId = Auth::id();

    $vakken = Vak::whereIn('id', function ($query) use ($userId) {
        $query->select('vak_id')
            ->from('docenten_vakken')
            ->where('docent_id', $userId);
    })->get();

    return view('docent.create-klas', ['vakken' => $vakken]);
})->middleware(['auth', DocentMiddleware::class])->name('create-klas');

Route::get('/create-groepen-evaluatie', function () {
    $userId = Auth::id();

    $vakken = Vak::whereIn('id', function ($query) use ($userId) {
        $query->select('vak_id')
            ->from('docenten_vakken')
            ->where('docent_id', $userId);
    })->get();

    return view('docent.create-groepen-evaluatie', compact('vakken'));
});

Route::post('/studenten-klas', function (Request $req) {
    $data = $req->all();

    // Create the class
    $klas = Klas::create([
        'naam' => $data['klasNaam'],
        'vak_id' => $data['vakId']
    ]);

    $klasId = $klas->id;

    // Loop through students
    foreach ($data['students']['rows'] as $row) {
        $rolId = ($row['role'] == 'd') ? 2 : 1;

        // Check if user already exists
        $gebruiker = Gebruiker::where('r_nummer', $row['user id'])->first();

        if (!$gebruiker) {
            $password = Str::random(12);  // Generate a random password
            $gebruiker = Gebruiker::create([
                'r_nummer' => $row['user id'],
                'voornaam' => $row['first name'],
                'achternaam' => $row['last name'],
                'email' => $row['email'],
                'password' => '', // Initially empty
                'rol_id' => $rolId,
            ]);

            // Dispatch job to handle password hashing and email
            Queue::push(new MailUserPasswordJob($gebruiker, $password));
        }

        // Assign the user to the class
        StudentKlassen::create([
            'student_id' => $gebruiker->id,
            'klas_id' => $klasId
        ]);
    }

    return response()->json([
        'msg' => 'added students to klas',
        'status' => 201
    ], 201);
})->middleware('auth', DocentMiddleware::class, DecompressRequest::class);


require __DIR__ . '/auth.php';
