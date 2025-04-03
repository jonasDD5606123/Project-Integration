<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CompressResponse;
use App\Http\Middleware\DecompressRequest;
use App\Http\Middleware\DocentMiddleware;
use App\Models\Criterium;
use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Klas;
use App\Models\StudentKlassen;
use Illuminate\Support\Facades\Hash;

//protect api routes

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/evaluatie', function (Request $req) {
    $requestBody = $req->json()->all();
    $evaluatie = Evaluatie::create([
        'titel' => $requestBody['titel'],
        'beschrijving' => $requestBody['beschrijving'],
        'deadline' => $requestBody['deadline'],
        'vak_id' => $requestBody['vakId']
    ]);
    $evalId = $evaluatie->id;
    foreach ($requestBody['criteria'] as $criterium) {
        Criterium::create([
            'criterium' => $criterium['criterium'],
            'max_waarde' => $criterium['max_waarde'],
            'min_waarde' => $criterium['min_waarde'],
            'evaluatie_id' => $evalId
        ]);
    }
});

Route::post('/studenten-klas', function (Request $req) {
    // schrijf in controller classe
        $passwords = [];
        $newUsers = 0;
        $requestBody = $req->json()->all();

        $klas = Klas::create([
            'naam' => $requestBody['klasNaam'],
            'vak_id' => $requestBody['vakId']
        ]);
        
        $klasId = $klas->id;

        // validate!!! colnames match {check excel file leerkracht}
        foreach ($requestBody['students']['rows'] as $row) {
            $rolId = 1;
            if ($row['role'] == 'd') {
                $rolId = 2;
            }
            $gebruiker = Gebruiker::where('r_nummer', $row['user id'])->first();
            if (!$gebruiker) {
                $newUsers++;
                $password = \Illuminate\Support\Str::random(12);
                $gebruiker = Gebruiker::create([
                    'r_nummer' => $row['user id'],
                    'voornaam' => $row['first name'],
                    'achternaam' => $row['last name'],
                    'email' => $row['email'],
                    'password' => Hash::make($password),
                    'rol_id' => $rolId
                ]);

                $passwords[$gebruiker->r_nummer] = $password;
            }

            $gebruikerId = $gebruiker->id;

            StudentKlassen::create([
                'student_id' => $gebruikerId,
                'klas_id' => $klasId
            ]);
        }

        return response()->json([
            'msg' => 'added students to klas',
            'status' => 201,
            'users_created' => $newUsers,
            'passwords' => $passwords
        ]);
        
     })->middleware(DecompressRequest::class);
