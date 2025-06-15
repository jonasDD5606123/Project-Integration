{{-- filepath: resources/views/docent/create-docent.blade.php --}}
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Docent Toevoegen</title>
    @vite(['resources/js/app.js', 'resources/css/docentbeheer.css'])
</head>

<body>

    <div class="header">
        <h1 class="title">Docent toevoegen</h1>
        <a href="{{ url('/') }}" class="btn-back">← Terug</a>
    </div>

    <div class="container">
        <div class="section">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('create-docent') }}">
                @csrf

                <!-- Voornaam -->
                <div class="form-group">
                    <label for="voornaam">Voornaam</label>
                    <input id="voornaam" type="text" name="voornaam" value="{{ old('voornaam') }}" placeholder="Voornaam" required />
                    @error('voornaam')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Achternaam -->
                <div class="form-group">
                    <label for="achternaam">Achternaam</label>
                    <input id="achternaam" type="text" name="achternaam" value="{{ old('achternaam') }}" placeholder="Achternaam" required />
                    @error('achternaam')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <!-- E-mailadres -->
                <div class="form-group">
                    <label for="email">E-mailadres</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="voorbeeld@docent.be" required />
                    @error('email')
                        <div class="text-error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">Docent toevoegen</button>
            </form>
        </div>
    </div>

</body>
</html>
