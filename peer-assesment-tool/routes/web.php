<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/help', function () {
    return view('welcome');
});


// student
Route::get('/student/cursussen', function () {
    return view('student.cursussen');
});

Route::get('/student/dashboard', function () {
    return view('student.dashboard');

});

//Route::get('/student/beoordelingen', function () {
//   return view('student.beoordelingen');

//});


// docent
Route::get('/docent', function () {
    return view('docent.docentDashboard');
});

Route::get('/docent/cursussen', function () {
    return view('docent.cursussen');
});

Route::get('/docent/file', function () {
    return view('docent.file-import');
});

Route::get('/docent/klassen', function () {
    return view('docent.klassen');
});

Route::get('/docent/studenten', function () {
    return view('docent.studenten');
});

require __DIR__ . '/auth.php';


