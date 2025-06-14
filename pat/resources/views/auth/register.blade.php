<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registratie Pagina</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="card-glass">
        <h2 class="text-center mb-4">Registratie</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- R Nummer -->
            <div class="mb-3">
                <label for="r_nummer" class="form-label">R Nummer</label>
                <input id="r_nummer" class="form-control" type="text" name="r_nummer" value="{{ old('r_nummer') }}" placeholder="bv. R1234567" />
                @error('r_nummer')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Voornaam -->
            <div class="mb-3">
                <label for="voornaam" class="form-label">Voornaam</label>
                <input id="voornaam" class="form-control" type="text" name="voornaam" value="{{ old('voornaam') }}" placeholder="Je voornaam" required />
                @error('voornaam')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Achternaam -->
            <div class="mb-3">
                <label for="achternaam" class="form-label">Achternaam</label>
                <input id="achternaam" class="form-control" type="text" name="achternaam" value="{{ old('achternaam') }}" placeholder="Je achternaam" required />
                @error('achternaam')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="voorbeeld@domein.be" required />
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Role ID -->
            <div class="mb-3">
                <label for="rol_id" class="form-label">Rol ID</label>
                <input id="rol_id" class="form-control" type="number" name="rol_id" value="{{ old('rol_id') }}" placeholder="Bijv. 1" required />
                @error('rol_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Wachtwoord</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="••••••••" required />
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Bevestig wachtwoord</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Herhaal wachtwoord" required />
                @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom w-100">Registreren</button>
        </form>

        <div class="text-center mt-3">
            <a href="/">← Terug naar Home</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>