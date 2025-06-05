<?php

use App\Http\Controllers\DocentController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportGroepenController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\DecompressRequest;
use App\Http\Middleware\DocentMiddleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = Auth::user();
    if ($user->rol_id == 1) {
        return view('student.dashboard');
    } else if ($user->rol_id == 2) {
        return view('docent.dashboard');
    }
})->name("dashboard")->middleware(middleware: ['auth', 'verified']);



Route::middleware('auth', DocentMiddleware::class)->group(function () {
    Route::get('/groepen', [DocentController::class, 'groepen'])->name('docent.groepen');
    Route::get('/evaluatie', [DocentController::class, 'evaluatie'])->name('docent.evaluatie');
    Route::get('/evaluatie/create', [DocentController::class, 'evaluatieCreate'])->name('docent.evaluatie.create');
    Route::get('/evaluatie/{evaluatie}/edit', [DocentController::class, 'evaluatieEdit'])->name('docent.evaluatie.edit');
    Route::put('/evaluatie/{evaluatie}', [DocentController::class, 'evaluatieUpdate'])->name('evaluatie.update');

    Route::get('/studenten-beheer', [DocentController::class, 'studentenBeheer'])->name('docent.studentenbeheer');
    Route::get('/klas/create', [DocentController::class, 'klasCreate'])->name('docent.klas.create');
    Route::post('/klas/store', [DocentController::class, 'klasStore'])->name('docent.klas.store');
    Route::get('/klas/import', [DocentController::class, 'klasImport'])->name('docent.klas.import');
    Route::get('groepen/create', [DocentController::class, 'groepenCreate'])->name('docent.groepen.create');
    Route::get('groepen/import', [DocentController::class, 'groepenImport'])->name('docent.groepen.import');

    Route::post('/studenten-klas', [ImportController::class, 'importStudents'])->middleware(DecompressRequest::class);
    Route::post('/api/studenten-groepen', [ImportGroepenController::class, 'store']);
    Route::post('/studenten-groepen', [ImportGroepenController::class, 'importStudentGroups'])->middleware(DecompressRequest::class);
});

// For API route (recommended)


require __DIR__ . '/auth.php';
