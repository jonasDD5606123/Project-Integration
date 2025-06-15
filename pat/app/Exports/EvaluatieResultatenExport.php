<?php

namespace App\Exports;

use App\Models\Evaluatie;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EvaluatieResultatenExport implements FromArray, WithHeadings
{
    protected $evaluatieId;

    public function __construct($evaluatieId)
    {
        $this->evaluatieId = $evaluatieId;
    }

    public function array(): array
    {
        $evaluatie = Evaluatie::with(['groepen.studenten', 'criteria.scores'])->findOrFail($this->evaluatieId);

        $rows = [];
        foreach ($evaluatie->groepen as $groep) {
            foreach ($groep->studenten as $student) {
                $row = [
                    'Groep' => $groep->naam,
                    'Student' => $student->voornaam . ' ' . $student->achternaam,
                ];
                foreach ($evaluatie->criteria as $criterium) {
                    $score = $criterium->scores
                        ->where('student_id_geevalueerd', $student->id)
                        ->first();
                    $row[$criterium->criterium] = $score->score ?? '-';
                }
                $rows[] = $row;
            }
        }
        return $rows;
    }

    public function headings(): array
    {
        $evaluatie = Evaluatie::with('criteria')->findOrFail($this->evaluatieId);
        $headings = ['Groep', 'Student'];
        foreach ($evaluatie->criteria as $criterium) {
            $headings[] = $criterium->criterium;
        }
        return $headings;
    }
}
