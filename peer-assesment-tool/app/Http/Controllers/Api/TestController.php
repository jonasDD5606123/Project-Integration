<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateVakRequest;
use App\Models\Vak;
use Exception;

class TestController extends Controller
{
    public function createVak(CreateVakRequest $req) {
        $validatedData = $req->validated();

        $vak = new Vak($validatedData);

        try {
            $vak->save();
        }
        catch (Exception $e) {
            return response()->json([
                'msg' => "failed inserting vak.$e",
                'status' => 400
            ], 400);
        }

        return response()->json([
            'msg' => 'Vak inserted.',
            'status' => 201
        ], 201);
    }
}
