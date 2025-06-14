<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Evaluatie invullen</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="container mt-4">
        <h2>Evaluatie: {{ $evaluatie->titel }}</h2>

        <form action="{{ route('evaluatie.submit', ['evaluatie' => $evaluatie->id, 'student' => $gebruiker->id, 'groep' => $groep->id]) }}" method="POST">
            @csrf

            <input type="hidden" name="evaluator_id" value="{{ Auth::id() }}">

            @foreach ($criteria as $criterium)
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
                                       value="{{ floor(($criterium->min_waarde + $criterium->max_waarde) / 2) }}"
                                       oninput="document.getElementById('score_{{ $criterium->id }}').innerText = this.value;">
                            </div>
                            <div class="col-md-4">
                                <span class="badge bg-primary" id="score_{{ $criterium->id }}">
                                    {{ floor(($criterium->min_waarde + $criterium->max_waarde) / 2) }}
                                </span>
                            </div>
                        </div>

                        <label class="mt-2">Feedback (optioneel)</label>
                        <textarea name="feedbacks[{{ $criterium->id }}]"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Geef hier je feedback..."></textarea>
                    </div>
                </div>
            @endforeach

            <div class="card mb-3">
                <div class="card-header">Algemene Feedback</div>
                <div class="card-body">
                    <textarea name="algemene_feedback" class="form-control" rows="4"></textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-check"></i> Evaluatie Indienen
                </button>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg ms-2">Annuleren</a>
            </div>
        </form>
    </div>
</body>
</html>
