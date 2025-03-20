<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pagina</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">{{ __('Login') }}</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('E-mail') }}</label>
                    <input id="email" type="email" name="email" class="form-control" :value="old('email')" required autofocus autocomplete="username" placeholder="Voer je e-mail in">
                    @error('email')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('Wachtwoord') }}</label>
                    <input id="password" type="password" name="password" class="form-control" required autocomplete="current-password" placeholder="Voer je wachtwoord in">
                    @error('password')
                        <p class="text-danger mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">{{ __('Onthoud mij') }}</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">{{ __('Inloggen') }}</button>
            </form>

            <p class="text-center mt-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Wachtwoord vergeten?') }}</a><br>
                @endif
                <a href="/registratie">{{ __('Heb je geen account?') }}</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>