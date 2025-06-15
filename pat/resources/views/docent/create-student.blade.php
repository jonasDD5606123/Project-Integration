<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Toevoegen</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="card-glass mt-4">
        <h2 class="text-center mb-4">Student toevoegen</h2>

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('create-student') }}">
            @csrf

            <!-- R Nummer -->
            <div class="mb-3">
                <label for="r_nummer" class="form-label">R Nummer</label>
                <input id="r_nummer" class="form-control" type="text" name="r_nummer" value="{{ old('r_nummer') }}" placeholder="bv. R1234567" required />
                @error('r_nummer')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Voornaam -->
            <div class="mb-3">
                <label for="voornaam" class="form-label">Voornaam</label>
                <input id="voornaam" class="form-control" type="text" name="voornaam" value="{{ old('voornaam') }}" placeholder="Voornaam" required />
                @error('voornaam')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Achternaam -->
            <div class="mb-3">
                <label for="achternaam" class="form-label">Achternaam</label>
                <input id="achternaam" class="form-control" type="text" name="achternaam" value="{{ old('achternaam') }}" placeholder="Achternaam" required />
                @error('achternaam')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" placeholder="voorbeeld@student.be" required />
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password (hidden, generated in controller) -->
            {{-- No password field, password is generated automatically --}}

            <button type="submit" class="btn btn-custom w-100">Student toevoegen</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>