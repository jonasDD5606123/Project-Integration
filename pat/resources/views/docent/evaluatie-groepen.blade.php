<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Groepen voor Evaluatie</title>
    @vite(['resources/js/app.js', 'resources/css/evaluaties.css'])
</head>

<body>

    <header class="header" role="banner">
        <h1 class="title">
            <span class="user__voornaam">{{ auth()->user()->voornaam }} {{ auth()->user()->achternaam }}</span>
        </h1>

        <div class="logout-form">
            <a href="{{ route('docent.raporten') }}" class="btn-back" role="button" aria-label="Terug naar home">← Terug</a>
        </div>
    </header>

    <div class="container">
        <h2>Groepen voor evaluatie: {{ $evaluatie->titel }}</h2>

        <div class="btn-group">
            <a href="{{ route('evaluatie.export', $evaluatie->id) }}" class="btn">📥 Download Excel</a>
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Groepnaam</th>
                    <th>Vak</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse($evaluatie->groepen as $groep)
                    <tr>
                        <td>{{ $groep->naam }}</td>
                        <td>{{ $groep->vak->naam ?? '-' }}</td>
                        <td>
                            <a href="{{ route('evaluatie.resultaten', [$evaluatie->id, $groep->id]) }}" class="btn-sm">
                                📊 Bekijk resultaten
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted">Geen groepen gevonden voor deze evaluatie.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>

</html>
