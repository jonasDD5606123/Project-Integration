<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Evaluatie Aanmaken</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js', 'resources/js/create-evaluatie.js', 'resources/css/create-evaluatie.css'])
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
        <div class="form-wrapper">
            <h2>Evaluatie Aanmaken</h2>

            @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form>
                @csrf
                <div>
                    <label for="inTitle">Titel</label>
                    <input id="inTitle" type="text" name="titel" placeholder="Evaluatie Titel" required>
                </div>

                <div>
                    <label for="inDesc">Beschrijving</label>
                    <textarea id="inDesc" name="beschrijving" rows="4" placeholder="Beschrijf de evaluatie..." required></textarea>
                </div>

                <div>
                    <label for="inDeadline">Deadline</label>
                    <input id="inDeadline" type="datetime-local" name="deadline" required>
                </div>

                <div>
                    <label for="selVakId">Vak</label>
                    <select id="selVakId" name="vak_id" required>
                        <option value="">Selecteer een vak</option>
                        @foreach ($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="criteriaContainer" class="criteria-container"></div>

                <button id="btnAddCriterium" type="button" class="btn btn-outline">➕ Criterium Toevoegen</button>
                <button type="submit" class="btn btn-primary" style="margin-top: 30px;">✅ Evaluatie Aanmaken</button>
            </form>

            <div id="feedback"></div>
        </div>
    </main>

</body>

</html>