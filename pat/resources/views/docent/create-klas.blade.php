<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klas Aanmaken - Peer Beoordelingstool</title>
    @vite(['resources/js/app.js', 'resources/css/dashboard-docent.css', 'resources/css/create-klas.css'])
</head>

<body>
    <header class="header">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; position: relative;">
            <h1>Klas Aanmaken <span class="user__voornaam">{{ auth()->user()->voornaam }}</span></h1>
            <a href="{{ route('docent.studentenbeheer') }}" class="btn-back">
                Back
            </a>
        </div>

    </header>

    <main class="container">

        <section class="card">
            <h2>Nieuwe Klas Aanmaken</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('docent.klas.store') }}">
                @csrf

                <!-- Klas name -->
                <div class="form-column">
                    <label for="inKlasNaam">Klas Naam</label>
                    <input id="inKlasNaam" type="text" name="naam" class="input-select" required>
                </div>

                <!-- Vak select -->
                <div class="form-column">
                    <label for="selVakId">Vak</label>
                    <select id="selVakId" name="vak_id" class="input-select" required>
                        <option value="">Selecteer een vak</option>
                        @foreach($vakken as $vak)
                            <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Student search + select -->
                <div class="form-column">
                    <label for="studentSearch">Studenten Zoeken</label>
                    <input type="text" id="studentSearch" class="input-select" placeholder="Zoek op naam of r_nummer...">
                </div>

                <div class="form-column">
                    <label for="studentSelect">Studenten Selecteren</label>
                    <select id="studentSelect" name="studenten[]" multiple class="input-select" required>
                        @foreach($studenten as $student)
                            <option value="{{ $student->id }}"
                                data-search="{{ strtolower($student->voornaam . ' ' . $student->achternaam . ' ' . $student->r_nummer) }}">
                                {{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->r_nummer }}) - {{ $student->email }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Houd Ctrl (Windows) of Cmd (Mac) ingedrukt om meerdere studenten te selecteren.</small>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn">Klas Aanmaken</button>
            </form>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('studentSearch');
            const select = document.getElementById('studentSelect');

            searchInput.addEventListener('input', function () {
                const term = this.value.trim().toLowerCase();
                Array.from(select.options).forEach(option => {
                    option.style.display = option.dataset.search.includes(term) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>