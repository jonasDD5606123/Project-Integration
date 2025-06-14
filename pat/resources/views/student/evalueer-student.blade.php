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

        <form method="POST" action="{{ route('evaluatie.opslaan', [$evaluatie->id, $groep->id]) }}">
            @csrf

            <div class="card border-danger mb-4">
                <div class="card-header bg-danger text-white">Selecteer Student</div>
                <div class="card-body">
                    <select class="form-select" id="student_id" name="student_id" required>
                        <option value="">-- Kies een student --</option>
                        @foreach($groep->studenten as $student)
                            <option value="{{ $student->id }}">{{ $student->naam }} ({{ $student->email }})</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card border-danger mb-4">
                <div class="card-header bg-danger text-white">Criteria Beoordeling</div>
                <div class="card-body">
                    @foreach($evaluatie->criteria as $criterium)
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                {{ $criterium->criterium }}
                                <small class="text-muted">(min: {{ $criterium->min_waarde }}, max: {{ $criterium->max_waarde }})</small>
                            </label>
                            <input
                                type="number"
                                class="form-control"
                                name="criteria[{{ $criterium->id }}]"
                                min="{{ $criterium->min_waarde }}"
                                max="{{ $criterium->max_waarde }}"
                                required
                            >
                        </div>
                    @endforeach
                </div>
            </div>

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
