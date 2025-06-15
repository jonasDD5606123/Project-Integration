<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Dashboard</title>
    @vite(['resources/js/app.js', 'resources/css/Student/student-dashboard.css'])
</head>

<body>

    <header class="header" role="banner">
        <h1 class="title">
            <span class="user__voornaam">{{ Auth::user()->name }}</span>
        </h1>
        <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar home">← Terug</a>
    </header>

    <main class="container" role="main">
        <h2>Student Dashboard</h2>
        <div class="row">
            <!-- Beheer Evaluaties -->
            <section class="section" aria-labelledby="beheer-evaluaties-title">
                <h4 id="beheer-evaluaties-title">Beheer Evaluaties</h4>
                <p class="text-muted">
                    Bekijk of wijzig eerder ingevulde evaluaties.
                </p>
                <a href="{{ route('student.groepen')}}" class="btn btn-primary">Ga naar groepen</a>
            </section>

            <!-- Beheer Evaluaties -->
            <section class="section" aria-labelledby="beheer-evaluaties-title">
                <h4 id="beheer-evaluaties-title">Beheer Evaluaties</h4>
                <p class="text-muted">
                    Bekijk of wijzig eerder ingevulde evaluaties.
                </p>
                <a href="{{route('student.evaluations')}}" class="btn"><span class="emoji">📋</span> Bekijk evaluaties</a>
            </section>

            <!-- Profiel / Hulp -->
            <section class="section" aria-labelledby="profiel-hulp-title">
                <h4 id="profiel-hulp-title">Profiel / Hulp</h4>
                <p class="text-muted">
                    Bekijk je profiel of krijg hulp bij het invullen van evaluaties.
                </p>
                <a href="{{route('profile.edit')}}" class="btn"><span class="emoji">📋</span> Bekijk evaluaties</a>
            </section>
    </main>

</body>

</html>