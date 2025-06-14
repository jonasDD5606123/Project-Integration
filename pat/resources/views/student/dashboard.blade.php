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
            <!-- Select Group -->
            <div class="col-md-6 mb-4">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Groep Selecteren</h5>
                        <p class="card-text">Kies een groep waarvoor je een evaluatie wilt doen.</p>
                        <a href="{{ route('student.groepen')}}" class="btn btn-primary">Ga naar groepen</a>
                    </div>
                </div>
            </div>

        <!-- Groep Selecteren -->
        <section class="section" aria-labelledby="groep-selecteren-title">
            <h4 id="groep-selecteren-title">Groep Selecteren</h4>
            <p class="text-muted">
                Kies een groep waarvoor je een evaluatie wilt doen.
            </p>
            <a href="{{ url('/groepen') }}" class="btn"><span class="emoji">👥</span> Ga naar groepen</a>
        </section>

        <!-- Evaluatie Invullen -->
        <section class="section" aria-labelledby="evaluatie-invullen-title">
            <h4 id="evaluatie-invullen-title">Evaluatie Invullen</h4>
            <p class="text-muted">
                Evalueer een groepsgenoot op basis van criteria.
            </p>
            @if(isset($groep))
                <a href="{{ route('student.groep', ['groep' => $groep->id]) }}" class="btn"><span class="emoji">📝</span> Kies groepsgenoot</a>
            @else
                <p class="text-muted">Nog geen groep geselecteerd.</p>
            @endif
        </section>

        <!-- Beheer Evaluaties -->
        <section class="section" aria-labelledby="beheer-evaluaties-title">
            <h4 id="beheer-evaluaties-title">Beheer Evaluaties</h4>
            <p class="text-muted">
                Bekijk of wijzig eerder ingevulde evaluaties.
            </p>
            <a href="#" class="btn"><span class="emoji">📋</span> Bekijk evaluaties</a>
        </section>

        <!-- Profiel / Hulp -->
        <section class="section" aria-labelledby="profiel-hulp-title">
            <h4 id="profiel-hulp-title">Profiel / Hulp</h4>
            <p class="text-muted">
                Bekijk je profiel of krijg hulp bij het invullen van evaluaties.
            </p>
            <a href="#" class="btn"><span class="emoji">🙋</span> Naar profiel</a>
        </section>
    </main>

</body>

</html>
