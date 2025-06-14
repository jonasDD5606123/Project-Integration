<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Student Dashboard</title>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Welkom, {{ Auth::user()->name }}</h2>

        <div class="row">
            <!-- Select Group -->
            <div class="col-md-6 mb-4">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Groep Selecteren</h5>
                        <p class="card-text">Kies een groep waarvoor je een evaluatie wilt doen.</p>
                        <a href="{{ url('/groepen') }}" class="btn btn-primary">Ga naar groepen</a>
                    </div>
                </div>
            </div>

            <!-- Evaluate a Peer -->
            <div class="col-md-6 mb-4">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h5 class="card-title">Evaluatie Invullen</h5>
                        <p class="card-text">Evalueer een groepsgenoot op basis van criteria.</p>
                        @if(isset($groep))
                            <a href="{{ route('student.groep', ['groep' => $groep->id]) }}" class="btn btn-success">Kies groepsgenoot</a>
                        @else
                            <p class="text-muted">Nog geen groep geselecteerd.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Manage Evaluations (Optional) -->
            <div class="col-md-6 mb-4">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <h5 class="card-title">Beheer Evaluaties</h5>
                        <p class="card-text">Bekijk of wijzig eerder ingevulde evaluaties.</p>
                        <a href="" class="btn btn-info">Bekijk evaluaties</a>
                    </div>
                </div>
            </div>

            <!-- Profile/Help (Optional) -->
            <div class="col-md-6 mb-4">
                <div class="card border-secondary h-100">
                    <div class="card-body">
                        <h5 class="card-title">Profiel / Hulp</h5>
                        <p class="card-text">Bekijk je profiel of krijg hulp bij het invullen van evaluaties.</p>
                        <a href="" class="btn btn-secondary">Naar profiel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>