<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaties Beheer</title>
    @vite(['resources/js/app.js', 'resources/css/evaluatie-docent.css'])
</head>

<body>
    <header class="header">
        <div class="container">
            <h1>Welkom <span>{{ auth()->user()->voornaam }}</span></h1>
        </div>
        <div class="logout-form">
            <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar home">← Terug</a>
        </div>
    </header>

   <main class="container">
    <a href="{{ url('/') }}" class="btn-back mt-4">⬅ Terug naar Dashboard</a>

    <div class="card-wrapper"> <!-- Toegevoegd -->
        <section class="new-evaluatie mt-4">
            <h2>Nieuwe Evaluatie Toevoegen</h2>
            <p class="text-muted">Maak een nieuwe evaluatie voor je vak. Klik op de knop hieronder om te beginnen.</p>
            <a href="{{ route('docent.evaluatie.create') }}" class="btn mt-2">➕ Nieuwe Evaluatie</a>
        </section>

        <section class="card mt-4">
            <h2>Bestaande Evaluaties</h2>
            <p class="text-muted">Hieronder zie je alle evaluaties die je tot nu toe hebt aangemaakt.</p>

            @if($evaluaties->isEmpty())
            <p class="text-muted">Geen evaluaties gevonden.</p>
            @else
            <ul class="list-group list-group-flush">
                @foreach($evaluaties as $evaluatie)
                <li class="list-group-item">
                    <strong>{{ $evaluatie->titel }}</strong>
                    <span class="text-muted"> (Deadline: {{ $evaluatie->deadline }})</span>
                    <br>
                    <span class="text-secondary">Vak: {{ $evaluatie->vak->naam ?? '-' }}</span>
                    <p>{{ $evaluatie->beschrijving }}</p>
                    <a href="{{ route('docent.evaluatie.edit', $evaluatie->id) }}" class="btn btn-sm mt-2">✏️ Bewerken</a>
                </li>
                @endforeach
            </ul>
            @endif
        </section>
    </div> <!-- Einde card-wrapper -->
</main>

</body>

</html>