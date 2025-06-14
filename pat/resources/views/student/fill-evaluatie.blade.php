<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Groepen beheer</title>
    @vite([
        'resources/js/app.js',
        'resources/css/app.css'
    ])
</head>

<body>
   <div class="container mt-4">
    <h2>Evaluatie: {{ $evaluatie->titel }}</h2>
    <form method="POST" action="{{ route('evaluatie.opslaan', [$evaluatie->id, $groep->id]) }}">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Selecteer student</label>
            <select class="form-select" id="student_id" name="student_id" required>
                <option value="">-- Kies een student --</option>
                @foreach($groep->studenten as $student)
                    <option value="{{ $student->id }}">{{ $student->naam }} ({{ $student->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <h5>Criteria</h5>
            @foreach($evaluatie->criteria as $criterium)
                <div class="mb-2">
                    <label class="form-label">
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

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>
</body>
</html>