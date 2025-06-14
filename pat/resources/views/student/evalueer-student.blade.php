<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Evaluatie invullen</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container mt-4">
        <h2 class="mb-4 text-danger">Evaluatie: {{ $evaluatie->titel }}</h2>

        <form method="POST"  action="{{ route('evaluatie.submit', ['evaluatie' => $evaluatie->id, 'student' => $gebruiker->id, 'groep' => $groep->id]) }}">
            @csrf

            <input type="hidden" name="evaluator_id" value="{{ Auth::id() }}">

            @foreach ($criteria as $criterium)
            @php
            $existingScore = $existingScores[$criterium->id]->score ?? floor(($criterium->min_waarde + $criterium->max_waarde) / 2);
            $existingFeedback = $existingScores[$criterium->id]->feedback ?? '';
            @endphp

            <div class="card mb-3">
                <div class="card-header">{{ $criterium->criterium }}</div>
                <div class="card-body">
                    <label>Score ({{ $criterium->min_waarde }} - {{ $criterium->max_waarde }})</label>
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <input type="range"
                                class="form-range"
                                name="scores[{{ $criterium->id }}]"
                                min="{{ $criterium->min_waarde }}"
                                max="{{ $criterium->max_waarde }}"
                                value="{{ old('scores.' . $criterium->id, $existingScore) }}"
                                oninput="document.getElementById('score_{{ $criterium->id }}').innerText = this.value;">
                        </div>
                        <div class="col-md-4">
                            <span class="badge bg-primary" id="score_{{ $criterium->id }}">
                                {{ old('scores.' . $criterium->id, $existingScore) }}
                            </span>
                        </div>
                    </div>

                    <label class="mt-2">Feedback (optioneel)</label>
                    <textarea name="feedbacks[{{ $criterium->id }}]"
                        class="form-control"
                        rows="3"
                        placeholder="Geef hier je feedback...">{{ old('feedbacks.' . $criterium->id, $existingFeedback) }}</textarea>
                </div>
            </div>
            @endforeach

            <div class="text-center">
                <button type="submit" class="btn btn-danger btn-lg">
                    <i class="fas fa-save"></i> Opslaan
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg ms-2">Annuleren</a>
            </div>
        </form>
    </div>
</body>

</html>