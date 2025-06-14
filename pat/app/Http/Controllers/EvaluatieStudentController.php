<?php

namespace App\Http\Controllers;

use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Groep;
use App\Models\Score;
use App\Models\StudentGroepen;
use Carbon\Carbon;
use COM;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluatieStudentController extends Controller
{
    public function groepen(Request $request)
    {
        $user = Auth::user();

        // Get groep IDs where the user is a student
        $groepenIds = StudentGroepen::where('student_id', $user->id)->pluck('groep_id');

        // Get groups with their vak, studenten and evaluatie, but only if evaluatie deadline not passed
        $groepen = Groep::with('vak', 'studenten', 'evaluatie')
            ->whereIn('id', $groepenIds)
            ->whereHas('evaluatie', function ($query) {
                $query->where('deadline', '>=', now());
            })
            ->get();

        return view('student.groepen', ['groepen' => $groepen]);
    }   // Logic to retrieve and return groups for the st   udent

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

        if ($authUser->id === $student) {
            abort(403, 'Je kunt jezelf niet evalueren.');
        }

        $groep = Groep::with('studenten')->findOrFail($groepId);

        if (!$groep->studenten->contains('id', $authUser->id)) {
            abort(403, 'Je maakt geen deel uit van deze groep.');
        }

        if (!$groep->studenten->contains('id', $student)) {
            abort(403, 'De geselecteerde student zit niet in deze groep.');
        }

        $evaluatie = Evaluatie::with('criteria')->findOrFail($evaluatieId);
        $criteria = $evaluatie->criteria()->orderBy('id')->get();

        // ✅ Fetch existing scores by this evaluator for the selected student and criteria
        $existingScores = Score::where('student_id_geevalueerd', $student)
            ->where('student_id_evalueert', $authUser->id)
            ->whereIn('criterium_id', $criteria->pluck('id'))
            ->get()
            ->keyBy('criterium_id'); // Makes it easy to access in the view

        return view('student.evalueer-student', [
            'evaluatie' => $evaluatie,
            'groep' => $groep,
            'gebruiker' => Gebruiker::findOrFail($student),
            'criteria' => $criteria,
            'existingScores' => $existingScores,
        ]);
    }

    public function submit(Request $request, $evaluatieId, $studentId, $groepId)
    {
        $evaluatorId = $request->input('evaluator_id');
        $scores = $request->input('scores', []);
        $feedbacks = $request->input('feedbacks', []);

        foreach ($scores as $criteriumId => $scoreValue) {
            $feedback = $feedbacks[$criteriumId] ?? null;

            Score::create([
                'criterium_id' => $criteriumId,
                'student_id_geevalueerd' => $studentId,
                'student_id_evalueert' => $evaluatorId,
                'score' => $scoreValue,
                'feedback' => $feedback,
                'gescoord_op' => Carbon::now(),
            ]);
        }

        // Optionally, handle algemene feedback
        // You could store it in a separate table if needed.

        return redirect()->back()->with('success', 'Evaluatie succesvol ingediend.');
    }
}
