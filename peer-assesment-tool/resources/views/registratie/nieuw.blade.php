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
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Registratie</h1>
            <form action="{{ route('registratie') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">username</label>
                    <input type="text" name="username" class="form-control" placeholder="Voer je username in" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">voornaam</label>
                    <input type="text" name="voornaam" class="form-control" placeholder="Voer je voornaam in" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">familienaam</label>
                    <input type="text" name="familienaam" class="form-control" placeholder="Voer je familienaam in" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">email</label>
                    <input type="email" name="email" class="form-control" placeholder="Voer je email in" required>
                </div>
                <div class="mb-3">
                <label class="form-label">rol</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Kies een rol</option>
                        <option value="1">Student</option>
                        <option value="2">Docent</option>
                        <option value="3">Administrator</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Wachtwoord</label>
                    <input type="password" name="password" class="form-control" placeholder="Voer je wachtwoord in" required>
                </div>
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