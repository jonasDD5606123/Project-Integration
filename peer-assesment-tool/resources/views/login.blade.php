<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/app.css" rel="stylesheet">
    <title>Login Pagina</title>
</head>
    <h1 class="text-center">Login</h1>
    <form action="{{ ('login') }}" method="post">
    @csrf
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" placeholder="Voer je e-mail in" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Wachtwoord</label>
                <input type="password" name="password" class="form-control" placeholder="Voer je wachtwoord in" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Inloggen</button>
        </form>
        
        <p class="text-center mt-3">
            <a href="#">Wachtwoord vergeten?</a>
        </p>
    </form>
    <script src="/js/app.js"></script>
</body>
</html>