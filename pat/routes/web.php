<?php

use App\Http\Controllers\DocentController;
use App\Http\Controllers\EvaluatieController;
use App\Http\Controllers\EvaluatieStudentController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ImportGroepenController;
use App\Http\Controllers\KlasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VakController;
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



Route::middleware('auth')->group(function () {
    Route::get('/student-groepen', [EvaluatieStudentController::class, 'groepen'])->name('student.groepen');
    Route::get('/student-groep/{groep}/', [EvaluatieStudentController::class, 'leden'])->name('student.groep');
    Route::get('/evaluatie/start/{evaluatie}/{student}/{groep}', [EvaluatieStudentController::class, 'evalueerPersoon'])
        ->name('evaluatie.start');
    Route::post('/evaluatie/submit/{evaluatie}/{student}/{groep}', [EvaluatieStudentController::class, 'storeEvaluatie'])->name('evaluatie.submit');
    Route::post('/evaluatie/{evaluatie}/student/{student}/groep/{groep}/submit', [EvaluatieStudentController::class, 'submit'])->name('evaluatie.submit');
    Route::get('/student/evaluations', [EvaluatieStudentController::class, 'index'])->name('student.evaluations');
        Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.edit');
});

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

    Route::get('/vakken', [VakController::class, 'create'])->name('vakken.create');
    Route::post('/vakken', [VakController::class, 'store'])->name('vakken.store');
    Route::post('/vakken/link', [VakController::class, 'link'])->name('vakken.link');
    Route::delete('/vakken/unlink', [VakController::class, 'unlink'])->name('vakken.unlink');
    Route::post('/api/evaluatie', [EvaluatieController::class, 'store'])->name('evaluatie.store');
    Route::get('/klas/manage', [KlasController::class, 'manage'])->name('klas.manage');

    Route::post('/klas/add-student', [KlasController::class, 'addStudent'])->name('klas.addStudent');

Route::get('/docent/raporten', [EvaluatieController::class, 'teacherIndex'])->name('docent.raporten');
Route::get('/docent/evaluaties/{evaluatie}/groepen', [EvaluatieController::class, 'showGroepen'])->name('evaluatie.groepen');
Route::get('/docent/evaluaties/{evaluatie}/resultaten', [EvaluatieController::class, 'resultaten'])->name('evaluatie.resultaten');
Route::get('/docent/evaluaties/{evaluatie}/groepen/{groep}/resultaten', [EvaluatieController::class, 'groepResultaten'])->name('evaluatie.resultaten');
});

// For API route (recommended)


require __DIR__ . '/auth.php';
