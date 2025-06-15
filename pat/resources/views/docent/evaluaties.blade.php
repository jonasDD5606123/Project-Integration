<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluaties</title>
    @vite(['resources/js/app.js', 'resources/css/evaluaties.css'])
</head>

<body>
    <header class="header" role="banner">
        <h1 class="title">
            <span class="user__voornaam">{{ auth()->user()->voornaam }} {{ auth()->user()->achternaam }}</span>
        </h1>

        <div class="logout-form">
            <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar home">← Terug</a>
        </div>
    </header>

    <div class="container">
        <h2>Evaluaties</h2>

        <!-- Filter Form -->
        <form method="GET">
            <label for="vak_id">Filter op vak:</label>
            <select name="vak_id" id="vak_id" onchange="this.form.submit()">
                <option value="">-- Alle vakken --</option>
                @foreach($vakken as $vak)
                    <option value="{{ $vak->id }}" {{ request('vak_id') == $vak->id ? 'selected' : '' }}>
                        {{ $vak->naam }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Evaluations Table -->
        <table>
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Vak</th>
                    <th>Deadline</th>
                    <th>Acties</th>
                </tr>
            </thead>
            <tbody>
                @forelse($evaluaties as $evaluatie)
                    <tr>
                        <td>{{ $evaluatie->titel }}</td>
                        <td>{{ $evaluatie->vak->naam ?? '-' }}</td>
                        <td>{{ $evaluatie->deadline }}</td>
                        <td>
                            <a href="{{ route('evaluatie.groepen', $evaluatie->id) }}" class="btn-sm">Bekijken</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted">Geen evaluaties gevonden.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
