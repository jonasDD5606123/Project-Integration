<?php

use App\Http\Middleware\DocentMiddleware;
use App\Models\Vak;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Contracts\Service\Attribute\Required;

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

require __DIR__ . '/auth.php';
