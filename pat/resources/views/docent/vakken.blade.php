<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Vakkenbeheer</title>
    @vite(['resources/js/app.js', 'resources/css/vakkenbeheer.css'])
</head>

<body>
    <header class="header" role="banner">
        <h1 class="title">
            <span class="user__voornaam">{{ auth()->user()->voornaam }} {{ auth()->user()->achternaam }}</span>
        </h1>
        <div class="logout-form">
            <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar dashboard">← Terug</a>
        </div>
    </header>

    <div class="container">
        <h2>📘 Vakkenbeheer</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <section class="section">
            <h3>➕ Nieuw vak toevoegen</h3>
            <form action="{{ route('vakken.store') }}" method="POST">
                @csrf
                <label for="naam">Naam vak</label>
                <input type="text" id="naam" name="naam" value="{{ old('naam') }}" required>
                @error('naam')
                    <p class="text-error">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn">➕ Vak toevoegen</button>
            </form>
        </section>

        <section class="section">
            <h3>🔗 Koppel jezelf aan een bestaand vak</h3>
            <form action="{{ route('vakken.link') }}" method="POST">
                @csrf
                <label for="vak_id">Selecteer vak</label>
                <select name="vak_id" id="vak_id" required>
                    <option value="">-- Kies een vak --</option>
                    @foreach($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
                @error('vak_id')
                    <p class="text-error">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn">🔗 Vak koppelen</button>
            </form>
        </section>

        <section class="section">
            <h3>❌ Ontkoppel jezelf van een vak</h3>
            <form action="{{ route('vakken.unlink') }}" method="POST">
                @csrf
                @method('DELETE')
                <label for="unlink_vak_id">Selecteer vak om te ontkoppelen</label>
                <select name="vak_id" id="unlink_vak_id" required>
                    <option value="">-- Kies een vak --</option>
                    @foreach($userVakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
                @error('vak_id')
                    <p class="text-error">{{ $message }}</p>
                @enderror
                <button type="submit" class="btn-danger">❌ Vak ontkoppelen</button>
            </form>
        </section>
    </div>
</body>

</html>
