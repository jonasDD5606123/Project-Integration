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
                <li class="nav-item"><a class="nav-link " href="/student/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link active" href="/student/cursussen">Cursussen</a></li>
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

    <main class="container mt-4">
        <h2 class="mb-3">Lopende Groepstaken per Cursus</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Cursus</th>
                    <th>Lopende Groepstaken</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>cursussen</td>
                    <td>
                        <ul>
                            evaluatie
                        </ul>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

    <footer class="text-center bg-primary text-white py-2 mt-4">
        <p class="mb-0">&copy; 2025 Peer Beoordelingstool</p>
    </footer>
</body>

</html>
