<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beoordelingen - Peer Beoordelingstool</title>
    <!-- Bootstrap CSS via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <header class="text-center bg-primary text-white py-3">
            <h1>Beoordelingen</h1>
        </header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Cursussen</a></li>
                    <li class="nav-item"><a class="nav-link active" href="#">Beoordelingen</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Resultaten</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Afmelden</a></li>
                </ul>
            </div>
        </nav>
        <main class="mt-4">
            <section>
                <h2 class="mb-3">Openstaande Beoordelingen</h2>
                <div class="card p-3 bg-light border">
                    <h3>Data Analytics Peer Review</h3>
                    <p>Evalueer de bijdragen van je teamleden</p>
                    <progress value="60" max="100" class="w-100"></progress>
                    <button class="btn btn-primary mt-2">Beoordeling Voortzetten</button>
                </div>
            </section>
            <section class="mt-4">
                <h2>Voltooide Beoordelingen</h2>
                <div class="card p-3 bg-light border">
                    <h3>Innovation Eindopdracht</h3>
                    <p>Voltooid op: 10 jan 2025</p>
                    <button class="btn btn-primary">Bekijk Resultaat</button>
                </div>
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