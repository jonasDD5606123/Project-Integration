<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h1 class="mb-4 text-center">Login</h1>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success mb-3">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email Address --}}
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Voer je e-mail in">
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Wachtwoord</label>
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required autocomplete="current-password" placeholder="Voer je wachtwoord in">
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">Onthoud mij</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Inloggen</button>
            </form>

            <div class="text-center mt-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">Wachtwoord vergeten?</a><br>
                @endif
                <a href="/register">Heb je geen account?</a>
            </div>
        </div>
    </div>
</body>

</html>
