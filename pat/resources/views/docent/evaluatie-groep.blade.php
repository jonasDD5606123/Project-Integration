<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultatenmatrix</title>
    @vite(['resources/js/app.js', 'resources/css/evaluatie-groep.css'])
</head>

<body>

    <header class="header">
        <h1 class="title">
            <span class="user__voornaam">{{ auth()->user()->voornaam }} {{ auth()->user()->achternaam }}</span>
        </h1>
        <div class="logout-form">
            <a href="{{ route('evaluatie.groepen', $evaluatie->id) }}" class="btn-back" role="button">← Terug</a>
        </div>
    </header>

    <div class="container">
        <h2>Resultatenmatrix voor groep: {{ $groep->naam }} (Evaluatie: {{ $evaluatie->titel ?? 'Evaluatie '.$evaluatie->id }})</h2>


        <div class="matrix">
            <div class="matrix-scroll">

                <table>
                    <thead>
                        <tr>
                            <th>Ontvanger \ Gever</th>
                            @foreach($groep->studenten as $gever)
                            <th>{{ $gever->voornaam }} {{ $gever->achternaam }}</th>
                            @endforeach
                            <th>Totaal ontvangen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groep->studenten as $ontvanger)
                        @php $rowTotal = 0; @endphp
                        <tr>
                            <td class="fw-bold">{{ $ontvanger->voornaam }} {{ $ontvanger->achternaam }}</td>
                            @foreach($groep->studenten as $gever)
                            @php
                            $scoreSum = 0;
                            foreach($evaluatie->criteria as $criterium) {
                            $scoreSum += $criterium->scores
                            ->where('student_id_evalueert', $gever->id)
                            ->where('student_id_geevalueerd', $ontvanger->id)
                            ->sum('score');
                            }
                            $rowTotal += $scoreSum;
                            @endphp
                            <td>{{ $scoreSum !== 0 ? number_format($scoreSum, 2) : '-' }}</td>
                            @endforeach
                            <td class="fw-bold">{{ $rowTotal !== 0 ? number_format($rowTotal, 2) : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Totaal gegeven</th>
                            @foreach($groep->studenten as $gever)
                            @php
                            $colTotal = 0;
                            foreach($evaluatie->criteria as $criterium) {
                            $colTotal += $criterium->scores
                            ->where('student_id_gever', $gever->id)
                            ->whereIn('student_id_geevalueerd', $groep->studenten->pluck('id'))
                            ->sum('score');
                            }
                            @endphp
                            <td class="fw-bold">{{ $colTotal !== 0 ? number_format($colTotal, 2) : '-' }}</td>
                            @endforeach
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <h4 class="mt-5">📊 Samenvatting</h4>
        <div class="summary">
            <div class="matrix-scroll">

                <table>
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Totaal ontvangen</th>
                            <th>Gemiddeld ontvangen</th>
                            <th>Totaal gegeven</th>
                            <th>Gemiddeld gegeven</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($groep->studenten as $student)
                        @php
                        $ontvangen = 0;
                        $ontvangenCount = 0;
                        foreach($groep->studenten as $gever) {
                        foreach($evaluatie->criteria as $criterium) {
                        $scores = $criterium->scores
                        ->where('student_id_evalueert', $gever->id)
                        ->where('student_id_geevalueerd', $student->id);
                        $ontvangen += $scores->sum('score');
                        $ontvangenCount += $scores->count();
                        }
                        }

                        $gegeven = 0;
                        $gegevenCount = 0;
                        foreach($groep->studenten as $ontvanger) {
                        foreach($evaluatie->criteria as $criterium) {
                        $scores = $criterium->scores
                        ->where('student_id_evalueert', $student->id)
                        ->where('student_id_geevalueerd', $ontvanger->id);
                        $gegeven += $scores->sum('score');
                        $gegevenCount += $scores->count();
                        }
                        }
                        @endphp
                        <tr>
                            <td>{{ $student->voornaam }} {{ $student->achternaam }}</td>
                            <td>{{ $ontvangen !== 0 ? number_format($ontvangen, 2) : '-' }}</td>
                            <td>{{ $ontvangenCount > 0 ? number_format($ontvangen / $ontvangenCount, 2) : '-' }}</td>
                            <td>{{ $gegeven !== 0 ? number_format($gegeven, 2) : '-' }}</td>
                            <td>{{ $gegevenCount > 0 ? number_format($gegeven / $gegevenCount, 2) : '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>