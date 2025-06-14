<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <!-- Bootstrap CSS via CDN -->
</head>

<body>
    <header class="bg-primary text-white py-3 ps-3">
        <h1 class="mb-0">
            Welkom <span class="user__voornaam">{{ auth()->user()->voornaam }}</span>
        </h1>
        <form method="POST" action="{{ route('logout') }}" class="me-3">
            @csrf
            <button type="submit" class="btn btn-light text-primary">Uitloggen</button>
        </form>
    </header>

    <div class="container mt-4">
        <main class="mt-4">
            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Evaluaties</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Peer evaluatie toevoegen, beheren</h3>

                    <div class="d-flex justify-content-end mt-3 ">
                        <a href="{{ route('docent.evaluatie') }}" class="btn btn-primary px-4 py-2">Click voor meer details</a>
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
                        <a href="{{ route('docent.studentenbeheer') }}" class="btn btn-primary px-4 py-2">Click voor meer details</a>
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

</body>

</html>