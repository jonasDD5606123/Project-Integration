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
        <h1>Klasbeheer</h1>

        <form method="GET" action="{{ route('klas.manage') }}">
            <label for="vak_id">Vak:</label>
            <select name="vak_id" id="vak_id" onchange="this.form.submit()">
                    @foreach($vakken as $vak)
                    <option value="{{ $vak->id }}" {{ $selectedVakId == $vak->id ? 'selected' : '' }}>
                        {{ $vak->naam }}
                    </option>
                @endforeach
            </select>

            <label for="klas_id">Klas:</label>
            <select name="klas_id" id="klas_id" onchange="this.form.submit()">
                @foreach($klassen as $klas)
                    <option value="{{ $klas->id }}" {{ $selectedKlasId == $klas->id ? 'selected' : '' }}>
                        {{ $klas->naam }}
                    </option>
                @endforeach
            </select>
        </form>

        @if($students->count())
            <h2>Studenten in deze klas</h2>
            <ul>
                @foreach($students as $student)
                    <li>{{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->email }})</li>
                @endforeach
            </ul>
        @elseif($selectedKlasId)
            <p>Geen studenten gevonden in deze klas.</p>
        @endif

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Add Student Form -->
        <form method="POST" action="{{ route('klas.addStudent') }}" class="mt-4">
            @csrf
            <input type="hidden" name="klas_id" value="{{ $selectedKlasId }}">

            <label for="student_id">Student toevoegen:</label>
            <select name="student_id" id="student_id" required>
                <option value="">-- Kies een student --</option>
                @foreach(
                    \App\Models\Gebruiker::where('rol_id', 1)
                        ->whereNotIn('id', $students->pluck('id'))
                        ->orderBy('voornaam')
                        ->get() as $student
                )
                    <option value="{{ $student->id }}">
                        {{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->email }})
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>
</body>

</html>
