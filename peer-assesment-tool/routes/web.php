<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('file-import');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/help', function () {
    return view('welcome');
});

Route::get('/Login', [LoginController::class, 'showLoginForm'])->name('login');;
Route::post('/Login', [LoginController::class, 'login'])->name('login');



Route::get('/registratie', function () {
    return view('registratie.nieuw');
})->name('registratie');

require __DIR__ . '/auth.php';
