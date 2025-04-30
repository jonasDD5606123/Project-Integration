<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
    <!-- Bootstrap CSS via CDN -->
</head>

<body>
    <header class="bg-primary text-white py-3 ps-3">
        <h1 class="mb-0">
            Welkom <span class="user__voornaam">{{ auth()->user()->voornaam }}</span>
        </h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link active" href="/docent">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Peer Evaluatie</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/klassen">Klassen</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/cursussen">cursussen</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/studenten">Studenten</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/file">Importing</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link"
                            style="text-decoration: none;">Afmelden</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <main class="mt-4">
            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Evaluaties</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Peer evaluatie toevoegen, beheren</h3>

                    <div class="d-flex justify-content-end mt-3 ">
                        <a href="{{ route('create-evaluatie') }}" class="btn btn-primary px-4 py-2">Click voor meer details</a>
                    </div>
                </div>
            </section>

            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Studenten</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Klassen toevoegen, beheren, onderverdelen in groepen, vakken toevoegen</h3>

                    <p class="card-text mb-3">
                        Geen beschrijving beschikbaar
                    </p>

                    <div class="d-flex justify-content-end mt-3 ">
                        <a href="{{ route('create-klas') }}" class="btn btn-primary px-4 py-2">Click voor meer details</a>
                    </div>
                </div>
            </section>

            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Raportering</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Klassen toevoegen, beheren, onderverdelen in groepen</h3>

                    <p class="card-text mb-3">
                        Geen beschrijving beschikbaar
                    </p>

                    <div class="d-flex justify-content-end mt-3 ">
                        <button class="btn btn-primary px-4 py-2"><a class="nav-link" href="/docent/klassen">Click voor meer details</a></button>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <footer class="text-center bg-primary text-white py-2 mt-4">
        <p class="mb-0">&copy; 2025 Peer Beoordelingstool</p>
    </footer>
</body>

</html>