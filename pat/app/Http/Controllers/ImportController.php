<?php

namespace App\Http\Controllers;


use App\Models\Klas;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    public function importStudents(Request $request)
    {
        $content = $request->getContent();
        if ($request->header('Content-Encoding') === 'gzip') {
            $content = gzdecode($content);
        }
        $data = json_decode($content, true);

        if (
            !$data ||
            !isset($data['students']['rows']) ||
            !is_array($data['students']['rows'])
        ) {
            return response()->json(['error' => 'Invalid or missing students data'], 400);
        }

        // Create the class (Klas)
        $klas = Klas::create([
            'naam' => $data['klasNaam'],
            'vak_id' => $data['vakId']
        ]);
        $klasId = $klas->id;

        foreach ($data['students']['rows'] as $row) {
            $rolId = ($row['role'] == 'd') ? 2 : 1;

            // Check if user already exists
            $gebruiker = Gebruiker::where('r_nummer', $row['user id'])->first();

            if (!$gebruiker) {
                $password = \Illuminate\Support\Str::random(12);
                $gebruiker = Gebruiker::create([
                    'r_nummer' => $row['user id'],
                    'voornaam' => $row['first name'],
                    'achternaam' => $row['last name'],
                    'email' => $row['email'],
                    'password' => '', // Will be set by the job
                    'rol_id' => $rolId,
                ]);

                // Dispatch job to handle password hashing and email
                \Illuminate\Support\Facades\Queue::push(new \App\Jobs\MailUserPasswordJob($gebruiker, $password));
            }

            // Assign the user to the class (pivot table)
            $klas->studenten()->syncWithoutDetaching([$gebruiker->id]);
        }

        return response()->json([
            'msg' => 'added students to klas',
            'status' => 201
        ], 201);
    }
}
