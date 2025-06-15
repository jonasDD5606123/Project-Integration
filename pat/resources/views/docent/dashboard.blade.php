<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool Dashboard</title>
    @vite(['resources/js/app.js', 'resources/css/dashboard-docent.css'])
</head>

<body>
    <header class="header">
        <div class="container">
            <h1>Welkom <span>{{ auth()->user()->voornaam }}</span></h1>
        </div>

     <form method="POST" action="{{ route('logout') }}" class="logout-form" aria-label="Uitloggen">
        @csrf
        <button type="submit" class="btn-back">
            🚪 Uitloggen
        </button>
    </form>
    </header>

    <main class="container">
        <section class="card">
            <h2>Evaluaties</h2>
            <p>Peer evaluatie toevoegen of beheren.</p>
            <a href="{{ route('docent.evaluatie') }}" class="btn">Bekijk Details</a>
        </section>

        <section class="card">
            <h2>Studenten</h2>
            <p>Klassen toevoegen, beheren, onderverdelen in groepen, vakken toevoegen.</p>
            <a href="{{ route('docent.studentenbeheer') }}" class="btn">Bekijk Details</a>
        </section>

        <section class="card">
            <h2>docent acount aanmake</h2>
            <p>Rapporten van klassen en groepen bekijken.</p>
            <a href="/create-docent" class="btn">Bekijk Details</a>
        </section>
        <section class="card">
            <h2>Student acount aanmaken</h2>
            <p>Rapporten van klassen en groepen bekijken.</p>
            <a href="/create-student" class="btn">Bekijk Details</a>
        </section>
    </main>
</body>

</html>
