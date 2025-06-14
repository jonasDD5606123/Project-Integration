<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8" />
    <title>Evaluatie Bewerken</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js', 'resources/js/edit-evaluatie.js', 'resources/css/create-evaluatie.css'])
</head>
<body>

<header class="header">
    <div class="container">
        <h1>Welkom <span>{{ auth()->user()->voornaam }}</span></h1>
    </div>
    <div class="logout-form">
        <a href="{{ route('docent.evaluatie') }}" class="btn-back">← Terug</a>
    </div>
</header>

<main>
    <div class="container">
        <div class="form-wrapper">
            <h2>Evaluatie Bewerken</h2>

            @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('evaluatie.update', $evaluatie->id) }}">
                @csrf
                @method('PUT')

                <div>
                    <label for="inTitle">Titel</label>
                    <input id="inTitle" type="text" name="titel" value="{{ $evaluatie->titel }}" required>
                </div>

                <div>
                    <label for="inDesc">Beschrijving</label>
                    <textarea id="inDesc" name="beschrijving" rows="4" required>{{ $evaluatie->beschrijving }}</textarea>
                </div>

                <div>
                    <label for="inDeadline">Deadline</label>
                    <input id="inDeadline" type="datetime-local" name="deadline" value="{{ $evaluatie->deadline->format('Y-m-d\TH:i') }}" required>
                </div>

                <div>
                    <label for="selVakId">Vak</label>
                    <select id="selVakId" name="vak_id" required>
                        <option value="">Selecteer een vak</option>
                        @foreach($vakken as $vak)
                            <option value="{{ $vak->id }}" @if($vak->id == $evaluatie->vak_id) selected @endif>{{ $vak->naam }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Bestaande criteria --}}
                @foreach($evaluatie->criteria as $i => $criterium)
                <div class="criterium-group">
                    <label>Criterium</label>
                    <input type="text" name="criteria[{{ $i }}][criterium]" value="{{ $criterium->criterium }}" required>

                    <label>Min Waarde</label>
                    <input type="number" name="criteria[{{ $i }}][min_waarde]" value="{{ $criterium->min_waarde }}" required>

                    <label>Max Waarde</label>
                    <input type="number" name="criteria[{{ $i }}][max_waarde]" value="{{ $criterium->max_waarde }}" required>

                    <input type="hidden" name="criteria[{{ $i }}][id]" value="{{ $criterium->id }}">
                    <button type="button" class="btn btn-remove btnRemoveCriterium">❌ Verwijder</button>
                </div>
                @endforeach

                {{-- Container voor nieuwe criteria --}}
                <div id="criteriaContainer" class="criteria-container"></div>

                <button id="btnAddCriterium" type="button" class="btn btn-outline">➕ Criterium toevoegen</button>

                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">✅ Opslaan</button>
            </form>
        </div>
    </div>
</main>

<script>
    window.criteriaNextIndex = {{ count($evaluatie->criteria) }};
</script>

</body>
</html>
