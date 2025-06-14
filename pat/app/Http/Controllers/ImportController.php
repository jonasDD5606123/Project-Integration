<?php

namespace App\Http\Controllers;

use App\Jobs\MailUserPasswordJob;
use App\Models\Klas;
use App\Models\Gebruiker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\URL;
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

    $klas = Klas::create([
        'naam' => $data['klasNaam'],
        'vak_id' => $data['vakId']
    ]);
    $klasId = $klas->id;

    foreach ($data['students']['rows'] as $row) {
        $rolId = ($row['role'] == 'd') ? 2 : 1;

        $gebruiker = Gebruiker::where('r_nummer', $row['user id'])->first();

        if (!$gebruiker) {
            // Generate a random password
            $randomPassword = Str::random(12);

            $gebruiker = Gebruiker::create([
                'r_nummer' => $row['user id'],
                'voornaam' => $row['first name'],
                'achternaam' => $row['last name'],
                'email' => $row['email'],
                'password' => '', // initially empty, set in job
                'rol_id' => $rolId,
            ]);

            // Generate signed URL with user ID and password as params
            $signedUrl = URL::signedRoute('password.setup', [
                'user' => $gebruiker->id,
                'password' => $randomPassword,
            ]);

            dispatch(new MailUserPasswordJob($gebruiker, $randomPassword, $signedUrl));
        }

        $klas->studenten()->syncWithoutDetaching([$gebruiker->id]);
    }

    return response()->json([
        'msg' => 'Added students to klas',
        'status' => 201
    ], 201);
}
}
