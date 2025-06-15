<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wachtwoord Resetten</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="card-glass">
        <h2 class="text-center mb-4">Reset Wachtwoord</h2>

        {{-- Session Status --}}
        @if (session('status'))
        <div class="bg-success text-white p-2 rounded mb-3">
            {{ session('status') }}
        </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
        <div class="bg-danger text-white p-2 rounded mb-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Hidden Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email', $request->email) }}"
                    required autofocus autocomplete="username" placeholder="voorbeeld@domein.be" />
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Nieuw wachtwoord</label>
                <input id="password" class="form-control" type="password" name="password" required
                    autocomplete="new-password" placeholder="••••••••" />
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Bevestig wachtwoord</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
                    required autocomplete="new-password" placeholder="••••••••" />
                @error('password_confirmation')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom w-100">Reset Wachtwoord</button>
        </form>
    </div>

    <!-- Bootstrap JS (optioneel) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
