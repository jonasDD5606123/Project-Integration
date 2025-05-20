<?php

use App\Http\Middleware\DocentMiddleware;
use App\Models\Vak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Http\Request;
use App\Models\Groep;
use App\Models\Gebruiker;
use App\Models\StudentGroepen;
use Illuminate\Support\Facades\Log;

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

    return view('docent.create-klas', compact('vakken'));
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

Route::get('/kanban', function () {
    return view('docent.create-groepen');
});

Route::view('/groepen', 'docent.groepen')->name('groepen.index');
Route::view('/groep', 'docent.groep-details')->name('groepen.show');

Route::get('/peer-assessment', function () {
    return view('student.peer-evaluatie');
});

// Groepen import formulier (alleen voor docenten)
Route::get('/groepen-importeren', function () {
    $userId = Auth::id();

    // Alleen vakken van de docent ophalen
    $vakken = Vak::whereIn('id', function ($query) use ($userId) {
        $query->select('vak_id')
            ->from('docenten_vakken')
            ->where('docent_id', $userId);
    })->get();

    return view('docent.import-groepen', compact('vakken'));
})->middleware(['auth', DocentMiddleware::class])->name('groepen.import.view');


// POST: Opslaan van groepen en studenten in DB
Route::post('/groepen-importeren', function (Request $request) {
    $request->validate([
        'vak_id' => 'required|exists:vakken,id',
        'groepen' => 'required|array',
    ]);

   foreach ($request->groepen as $groepNaam => $studenten) {
    // Nieuwe groep aanmaken
    $groep = Groep::create([
        'naam' => $groepNaam,
        'vak_id' => $request->vak_id
    ]);

    // Studenten aan groep koppelen
    foreach ($studenten as $student) {
        // Gebruiker ophalen of aanmaken
        $gebruiker = Gebruiker::firstOrCreate(
            ['id' => $student['user_id']],
            [
                'r_nummer' =>$student['user_id'], // Of een default
                'voornaam' => $student['first_name'],
                'achternaam' => $student['last_name'],
                'email' => strtolower($student['first_name']) . '.' . strtolower($student['last_name']) . '@example.com',
                'password' => bcrypt('defaultpassword'), // tijdelijke default
                'rol_id' => 1 // bijv. 3 = student
            ]
        );

        // Koppelen aan groep
        StudentGroepen::create([
            'groep_id' => $groep->id,
            'student_id' => $gebruiker->id
        ]);
    }
}


    

    return response()->json(['success' => true, 'message' => 'Groepen en studenten succesvol opgeslagen.']);
})->middleware(['auth', DocentMiddleware::class])->name('groepen.import.save');

require __DIR__ . '/auth.php';
