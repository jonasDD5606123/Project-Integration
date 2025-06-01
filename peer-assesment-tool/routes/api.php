<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

use App\Http\Middleware\CompressResponse;
use App\Http\Middleware\DecompressRequest;
use App\Http\Middleware\DocentMiddleware;
use App\Mail\TeacherNewUsersMail;
use App\Models\Criterium;
use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Klas;
use App\Models\StudentKlassen;
use Illuminate\Support\Facades\Auth;
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

    return response()->json([
        'msg' => 'success',
        'status' => 201
    ], 201);
});

Route::post('/criterium', function (Request $req) {
    $data = $req->validate([
        'criterium' => 'string',
        'max_waarde' => 'integer',
        'min_waarde' => 'integer',
        'evaluatie_id' => 'integer'
    ]);

    try {
        Criterium::create($data);
    } catch (Exception  $e) {
        return response()->json([
            'msg' => 'failed creating criterium.',
            'status' => 400
        ], 400);
    }
    return response()->json([
        'msg' => 'criterium created succesfully.',
        'status' => 201
    ], 201);
});
