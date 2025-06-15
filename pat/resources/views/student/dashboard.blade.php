<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Dashboard</title>
    @vite(['resources/js/app.js', 'resources/css/Student/student-dashboard.css', 'resources/css/dashboard-docent.css'])
    <style>
        .header {
            background: linear-gradient(90deg, #d32f2f, #f44336);
        }
    </style>
</head>

<body>
    <header class="header" role="banner">
        <div class="header-content">
            <h1 class="title">
                Welkom, <span class="user__voornaam">{{ auth()->user()->voornaam }}</span>
            </h1>
            <form method="POST" action="{{ route('logout') }}" class="logout-form" aria-label="Uitloggen">
                @csrf
                <button type="submit" class="btn-back">🚪 Uitloggen</button>
            </form>
        </div>
    </header>

    <main class="container" role="main">
        <h2 class="dashboard-title">Student Dashboard</h2>

        <div class="dashboard-sections">
            <!-- Section 1 -->
            <section class="card" aria-labelledby="groepen-title">
                <h4 id="groepen-title">Beheer Groepen</h4>
                <p class="text-muted">Bekijk of wijzig je groepen.</p>
                <a href="{{ route('student.groepen') }}" class="btn btn-primary">Ga naar groepen</a>
            </section>

            <!-- Section 2 -->
            <section class="card" aria-labelledby="evaluaties-title">
                <h4 id="evaluaties-title">Beheer Evaluaties</h4>
                <p class="text-muted">Bekijk of wijzig eerder ingevulde evaluaties.</p>
                <a href="{{ route('student.evaluations') }}" class="btn"><span class="emoji">📋</span> Bekijk evaluaties</a>
            </section>

            <!-- Section 3 -->
            <section class="card" aria-labelledby="profiel-title">
                <h4 id="profiel-title">Profiel / Hulp</h4>
                <p class="text-muted">Wijzig hier je wachtwoord.</p>
                <a href="{{ route('profile.edit') }}" class="btn"><span class="emoji">👤</span> Wijzig wachtwoord</a>
            </section>
        </div>
    </main>
</body>

</html>
