<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registratie Pagina</title>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="p-3" style="width: 100%; max-width: 400px;">
            <h3 class="text-center mb-3">Registratie</h3>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- R Nummer -->
                <div class="mb-3">
                    <label for="r_nummer" class="form-label">{{ __('R Nummer') }}</label>
                    <input id="r_nummer" class="form-control" type="text" name="r_nummer" value="{{ old('r_nummer') }}" required autofocus autocomplete="r_nummer" />
                    @error('r_nummer')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Voornaam -->
                <div class="mb-3">
                    <label for="voornaam" class="form-label">{{ __('Voornaam') }}</label>
                    <input id="voornaam" class="form-control" type="text" name="voornaam" value="{{ old('voornaam') }}" required autocomplete="voornaam" />
                    @error('voornaam')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Achternaam -->
                <div class="mb-3">
                    <label for="achternaam" class="form-label">{{ __('Achternaam') }}</label>
                    <input id="achternaam" class="form-control" type="text" name="achternaam" value="{{ old('achternaam') }}" required autocomplete="achternaam" />
                    @error('achternaam')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                    @error('email')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Role ID (optional) -->
                <div class="mb-3">
                    <label for="rol_id" class="form-label">{{ __('Role ID') }}</label>
                    <input id="rol_id" class="form-control" type="number" name="rol_id" value="{{ old('rol_id') }}" required />
                    @error('rol_id')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    @error('password_confirmation')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Registreren</button>

            </form>

            <p class="text-center mt-3">
                <a href="/">Go back</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
