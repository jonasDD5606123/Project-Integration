@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <h2>Evaluatie: {{ $evaluatie->titel }}</h2>

        <form method="POST" action="{{ route('evaluatie.submit', ['evaluatie' => $evaluatie->id, 'student' => $gebruiker->id, 'groep' => $groep->id]) }}">
            @csrf

            <input type="hidden" name="evaluator_id" value="{{ Auth::id() }}">

            @foreach ($criteria as $criterium)
                @php
                    $existingScore = $existingScores[$criterium->id]->score ?? floor(($criterium->min_waarde + $criterium->max_waarde) / 2);
                    $existingFeedback = $existingScores[$criterium->id]->feedback ?? '';
                @endphp

                <div class="section">
                    <h4>{{ $criterium->criterium }}</h4>

                    <label for="score_{{ $criterium->id }}">Score ({{ $criterium->min_waarde }} - {{ $criterium->max_waarde }})</label>
                    <input
                        type="range"
                        class="input-range"
                        name="scores[{{ $criterium->id }}]"
                        min="{{ $criterium->min_waarde }}"
                        max="{{ $criterium->max_waarde }}"
                        value="{{ old('scores.' . $criterium->id, $existingScore) }}"
                        oninput="document.getElementById('score_value_{{ $criterium->id }}').innerText = this.value;">
                    <div class="score-badge-wrapper">
                        <span class="badge bg-primary" id="score_value_{{ $criterium->id }}">
                            {{ old('scores.' . $criterium->id, $existingScore) }}
                        </span>
                    </div>

                    <label for="feedback_{{ $criterium->id }}">Feedback (optioneel)</label>
                    <textarea
                        id="feedback_{{ $criterium->id }}"
                        class="textarea"
                        name="feedbacks[{{ $criterium->id }}]"
                        rows="3"
                        placeholder="Geef hier je feedback...">
                                {{ old('feedbacks.' . $criterium->id, $existingFeedback) }}</textarea>
                </div>
            @endforeach

            <div class="form-actions">
                <button type="submit" class="btn">
                    💾 Opslaan
                </button>
                <a href="{{ url()->previous() }}" class="btn-outline-secondary">
                    Annuleren
                </a>
            </div>
        </form>
    </div>
@endsection