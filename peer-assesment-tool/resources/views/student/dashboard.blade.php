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
                <li class="nav-item"><a class="nav-link active" href="/student/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/student/cursussen">Cursussen</a></li>
                <li class="nav-item"><a class="nav-link" href="/student/beoordelingen">Beoordelingen</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Resultaten</a></li>
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
            <section id="dashboard" class="page active">
                <h2 class="mb-3">Overzicht</h2>
                <div class="card p-3">
                    <p><strong>Totaal cursussen:</strong> 2</p>
                    <p><strong>Openstaande beoordelingen:</strong> 1</p>
                    <p><strong>Voltooide beoordelingen:</strong> 5</p>
                </div>
            </section>
            <section id="cursussen" class="page mt-4">
                <h2>Jouw Cursussen</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3 shadow">
                            <h3>Webontwikkeling</h3>
                            <p>Geen beschrijving beschikbaar</p>
                            <button class="btn btn-primary"><a class="nav-link" href="/student/cursussen">Bekijk Details</a></button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 shadow">
                            <h3>Data-analyse</h3>
                            <p>Geen beschrijving beschikbaar</p>
                            <button class="btn btn-primary">Bekijk Details</button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Openstaande Beoordelingen</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Webontwikkeling Peer Review</h3>

                    <p class="card-text mb-3">
                        Evalueer de bijdragen van je teamleden tegen <span class="text-danger">20/01/2026 20:00</span>
                    </p>

                    <progress value="60" max="100" class="progress w-100 mb-3 bg-info"></progress>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-primary px-4 py-2"><a class="nav-link" href="/student/beoordelingen">bekijk Details</a></button>
                    </div>
                </div>
            </section>

            <section id="resultaten" class="page mt-4">
                <h2>Ingevulde Beoordelingsresultaten</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cursus</th>
                            <th>Beoordeling</th>
                            <th>Score</th>
                            <th>Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Webontwikkeling</td>
                            <td>Eindopdracht</td>
                            <td>8.5/10</td>
                            <td>15 Jan 2025</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Webontwikkeling</td>
                            <td>Eindopdracht</td>
                            <td>8.5/10</td>
                            <td>15 Jan 2025</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Webontwikkeling</td>
                            <td>Eindopdracht</td>
                            <td>8.5/10</td>
                            <td>15 Jan 2025</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Webontwikkeling</td>
                            <td>Eindopdracht</td>
                            <td>8.5/10</td>
                            <td>15 Jan 2025</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Webontwikkeling</td>
                            <td>Eindopdracht</td>
                            <td>8.5/10</td>
                            <td>15 Jan 2025</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>Webontwikkeling</td>
                            <td>Eindopdracht</td>
                            <td>8.5/10</td>
                            <td>15 Jan 2025</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <footer class="text-center bg-primary text-white py-2 mt-4">
        <p class="mb-0">&copy; 2025 Peer Beoordelingstool</p>
    </footer>
</body>

</html>
