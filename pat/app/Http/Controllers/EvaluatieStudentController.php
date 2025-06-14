<?php

namespace App\Http\Controllers;

use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Groep;
use App\Models\StudentGroepen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluatieStudentController extends Controller
{
    public function groepen(Request $request)
    {
        $user = Auth::user();
        $groepenIds = StudentGroepen::where('student_id', $user->id)->get();
        $groepen = Groep::with('vak', 'studenten')
            ->whereIn('id', $groepenIds->pluck('groep_id'))
            ->get();
        return view('student.groepen', ['groepen' => $groepen]);
    }   // Logic to retrieve and return groups for the student

    public function leden(Request $request, int $groepId)
    {
        $user = Auth::user();

        // Retrieve the group by ID, or abort 404 if not found
        $groep = Groep::with('studenten')->findOrFail($groepId);

        // Check if the authenticated user is a member of this group
        $isLid = $groep->studenten->contains('id', $user->id);

        if (!$isLid) {
            abort(404); // return 404 Not Found if user is not in the group
        }

        // Filter out the authenticated user from the studenten collection
        $studentenWithoutUser = $groep->studenten->reject(function ($student) use ($user) {
            return $student->id === $user->id;
        });

        // Pass the group and filtered students to the view
        return view('student.team-leden', [
            'groep' => $groep,
            'studenten' => $studentenWithoutUser,
        ]);
    }

    public function evalueerPersoon(Request $request, int $evaluatieId, int $student, int $groepId)
    {
        $authUser = Auth::user();

        // ✅ Check 1: Prevent self-evaluation
        if ($authUser->id === $student) {
            abort(403, 'Je kunt jezelf niet evalueren.');
        }

        // ✅ Fetch the group and check if the authenticated user is in it
        $groep = Groep::with('studenten')->findOrFail($groepId);

        $isUserInGroup = $groep->studenten->contains('id', $authUser->id);
        if (!$isUserInGroup) {
            abort(403, 'Je maakt geen deel uit van deze groep.');
        }

        // ✅ Optional: Check if the target gebruiker is also in the group
        $isTargetInGroup = $groep->studenten->contains('id', $student);
        if (!$isTargetInGroup) {
            abort(403, 'De geselecteerde student zit niet in deze groep.');
        }

        // ✅ Optional: Load the evaluation
        $evaluatie = Evaluatie::with('criteria')->findOrFail($evaluatieId);
        $criteria = $evaluatie->criteria()->orderBy('id')->get();

        // ✅ Continue to evaluation logic or show view
        return view('student.evalueer-student', [
            'evaluatie' => $evaluatie,
            'groep' => $groep,
            'gebruiker' => Gebruiker::findOrFail($student),
            'criteria' => $criteria,
        ]);
    }
}
