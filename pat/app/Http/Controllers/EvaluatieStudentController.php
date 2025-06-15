<?php

namespace App\Http\Controllers;

use App\Models\Evaluatie;
use App\Models\Gebruiker;
use App\Models\Groep;
use App\Models\Score;
use App\Models\StudentGroepen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluatieStudentController extends Controller
{
    public function groepen(Request $request)
    {
        $user = Auth::user();

        // Get groep IDs where the user is a student
        $groepenIds = StudentGroepen::where('student_id', $user->id)->pluck('groep_id');

        // G        et groups with their vak, studenten and evaluatie, but only if evaluatie deadline not passed
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

        // Load group with students
        $groep = Groep::with('studenten')->findOrFail($groepId);

        // Check membership
        if (!$groep->studenten->contains('id', $user->id)) {
            abort(404);
        }

        // Remove the current user from the student list
        $studentenWithoutUser = $groep->studenten->reject(fn($student) => $student->id === $user->id);

        // Load evaluatie from groep
        $evaluatie = $groep->evaluatie;

        // Check if deadline is in the past
        if ($evaluatie->deadline && Carbon::now()->gt(Carbon::parse($evaluatie->deadline))) {
            return redirect()->back()->withErrors(['msg' => 'De deadline voor deze evaluatie is verstreken.']);
        } // assuming groep has evaluatie_id and the relation exists

        if (!$evaluatie) {
            return view('student.team-leden', [
                'groep' => $groep,
                'studenten' => $studentenWithoutUser,
                'fullyEvaluatedStudentIds' => [],
            ]);
        }

        $criteria = $evaluatie->criteria;
        $criteriaIds = $criteria->pluck('id')->toArray();

        // Fully evaluated students
        $fullyEvaluatedStudentIds = Score::where('student_id_evalueert', $user->id)
            ->whereIn('criterium_id', $criteriaIds)
            ->select('student_id_geevalueerd')
            ->groupBy('student_id_geevalueerd')
            ->havingRaw('COUNT(DISTINCT criterium_id) = ?', [count($criteriaIds)])
            ->pluck('student_id_geevalueerd')
            ->toArray();

        return view('student.team-leden', [
            'groep' => $groep,
            'studenten' => $studentenWithoutUser,
            'fullyEvaluatedStudentIds' => $fullyEvaluatedStudentIds,
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
        // Check if deadline is in the past
        if ($evaluatie->deadline && Carbon::now()->gt(Carbon::parse($evaluatie->deadline))) {
            return redirect()->back()->withErrors(['msg' => 'De deadline voor deze evaluatie is verstreken.']);
        }
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

            $existing = Score::where('criterium_id', $criteriumId)
                ->where('student_id_geevalueerd', $studentId)
                ->where('student_id_evalueert', $evaluatorId)
                ->first();

            if ($existing) {
                // Update existing record using query builder update
                Score::where('criterium_id', $criteriumId)
                    ->where('student_id_geevalueerd', $studentId)
                    ->where('student_id_evalueert', $evaluatorId)
                    ->update([
                        'score' => $scoreValue,
                        'feedback' => $feedback,
                        'gescoord_op' => now(),
                    ]);
            } else {
                // Create new record
                Score::create([
                    'criterium_id' => $criteriumId,
                    'student_id_geevalueerd' => $studentId,
                    'student_id_evalueert' => $evaluatorId,
                    'score' => $scoreValue,
                    'feedback' => $feedback,
                    'gescoord_op' => now(),
                ]);
            }
        }

        return redirect()->back()->with('success', 'Evaluatie succesvol ingediend.');
    }

    public function index($selectVak = null)
    {
        $student = Gebruiker::find(Auth::user()->id); // Get the logged-in student

        // Get all klassen for the student
        $klassen = $student->klassen()->with('vak')->get();

        // Get all vakken for those klassen (unique)
        $vakken = $klassen->pluck('vak')->unique('id')->values();
        // Get all evaluations connected via groups that include this student
        $evaluaties = Evaluatie::whereHas('groepen.studenten', function ($query) use ($student) {
            $query->where('gebruikers.id', $student->id);
        })->with(['groepen.studenten', 'criteria', 'vak'])->get();

        $filteredEvaluaties = [];

        foreach ($evaluaties as $evaluatie) {
            // Groups current student belongs to for this evaluation
            $studentGroups = $evaluatie->groepen->filter(function ($groep) use ($student) {
                return $groep->studenten->contains($student);
            });

            // Unique students in those groups
            $studenten = $studentGroups->flatMap->studenten->unique('id');

            // Skip if fewer than 2 students or no criteria
            if ($studenten->count() < 2 || $evaluatie->criteria->isEmpty()) {
                continue;
            }

            $aantalStudenten = $studenten->count();
            $aantalCriteria = $evaluatie->criteria->count();

            // Expected scores per student: criteria * (students - 1)
            $verwachteScoresPerStudent = $aantalCriteria * ($aantalStudenten - 1);

            // Actual scores given by current student for this evaluation's criteria
            $aantalScoresByStudent = Score::where('student_id_evalueert', $student->id)
                ->whereIn('criterium_id', $evaluatie->criteria->pluck('id'))
                ->count();

            $volledig = $aantalScoresByStudent >= $verwachteScoresPerStudent;
            $deadlinePassed = $evaluatie->deadline->isPast();

            // Show evaluations incomplete by this student (before or after deadline),
            // and completed ones before deadline
            if (!$volledig || ($volledig && !$deadlinePassed)) {
                $filteredEvaluaties[] = [
                    'evaluatie' => $evaluatie,
                    'volledig' => $volledig,
                    'deadlinePassed' => $deadlinePassed,
                    'verwachteScoresPerStudent' => $verwachteScoresPerStudent,
                    'aantalScoresByStudent' => $aantalScoresByStudent,
                ];
            }
        }

        // Sort by deadline ascending
        usort(
            $filteredEvaluaties,
            fn($a, $b) =>
            $a['evaluatie']->deadline->timestamp <=> $b['evaluatie']->deadline->timestamp
        );

        return view('student.evaluations', ['evaluaties' => $filteredEvaluaties]);
    }
}
