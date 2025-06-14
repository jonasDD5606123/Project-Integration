<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Klassenbeheer</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Klassenbeheer</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @foreach ($vakken as $vak)
            <h2>Vak: {{ $vak->naam }}</h2>

            @foreach ($vak->klassen as $klas)
                <div class="mb-4 border p-3 rounded">
                    <h3>Klas: {{ $klas->naam }}</h3>

                    <strong>Studenten:</strong>
                    <ul>
                        @forelse($klas->studenten as $student)
                            <li>{{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->r_nummer }})</li>
                        @empty
                            <li>Geen studenten gekoppeld.</li>
                        @endforelse
                    </ul>

                    <form action="{{ route('klas.addStudent') }}" method="POST" class="mt-3">
                        @csrf
                        <input type="hidden" name="klas_id" value="{{ $klas->id }}">

                        <div class="mb-3">
                            <label for="student_id_{{ $klas->id }}" class="form-label">Student toevoegen</label>
                            <select name="student_id" id="student_id_{{ $klas->id }}" class="form-select" required>
                                <option value="">-- Kies een student --</option>
                                @foreach ($students as $student)
                                    @if(!$klas->studenten->contains($student->id))
                                        <option value="{{ $student->id }}">{{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->r_nummer }})</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('student_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Student toevoegen</button>
                    </form>
                </div>
            @endforeach

            <hr>
        @endforeach
    </div>
</body>

</html>
