<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <header class="text-center bg-primary text-white py-3">
            <h1>Welkom bij Peer Beoordeling</h1>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#cursussen">Cursussen</a></li>
                    <li class="nav-item"><a class="nav-link" href="#beoordelingen">Beoordelingen</a></li>
                    <li class="nav-item"><a class="nav-link" href="#resultaten">Resultaten</a></li>
                    <li class="nav-item"><a class="nav-link" href="#afmelden">Afmelden</a></li>
                </ul>
            </div>
        </nav>
        <main class="mt-4">
            <section id="dashboard" class="page active">
                <h2 class="mb-3">Dashboard</h2>
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
                            <button class="btn btn-primary">Bekijk Details</button>
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
                <h2>Openstaande Beoordelingen</h2>
                <div class="card p-3 bg-light border">
                    <h3>Webontwikkeling Peer Review</h3>
                    <p>Evalueer de bijdragen van je teamleden</p>
                    <progress value="60" max="100" class="w-100"></progress>
                    <button class="btn btn-primary mt-2">Beoordeling Voortzetten</button>
                </div>
            </section>
            <section id="resultaten" class="page mt-4">
                <h2>Beoordelingsresultaten</h2>
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
                </table>
            </section>
            <section id="afmelden" class="page mt-4">
                <h2>Afmelden</h2>
                <p>Je staat op het punt om af te melden. Klik op de knop hieronder om door te gaan.</p>
                <button class="btn btn-danger">Afmelden</button>
            </section>
        </main>
        <footer class="text-center bg-primary text-white py-3 mt-4">
            <p>&copy; 2025 Peer Beoordelingstool</p>
        </footer>
    </div>
    <!-- Bootstrap JS via CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>