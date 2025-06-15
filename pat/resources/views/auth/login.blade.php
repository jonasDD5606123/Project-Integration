<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Pagina</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="card-glass">
        <h2 class="text-center mb-4">Inloggen</h2>

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

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mailadres</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}"
                    placeholder="voorbeeld@domein.be" required autofocus />
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Wachtwoord</label>
                <input id="password" class="form-control" type="password" name="password" placeholder="••••••••"
                    required />
                @error('password')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">
                    Onthoud mij
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-custom w-100">Inloggen</button>
        </form>

        <div class="text-center mt-3">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Wachtwoord vergeten?</a>
            @endif
            <br>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>