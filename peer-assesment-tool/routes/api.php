<?php

use App\Http\Controllers\Api\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CompressResponse;
use App\Http\Middleware\DecompressRequest;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware([DecompressRequest::class])
    ->post('/upload_list', function (Request $req) {
        $requestBody = $req->json()->all();
        return response()->json($requestBody);
});

// test toevoegen vak
Route::post('/vak', [TestController::class, 'createVak']);

Route::get('/vak', [TestController::class, 'getVak']);
