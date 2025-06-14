<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Groepsgenoten Evaluatie</title>
</head>

<body>
    <!-- Step 2: Select Partner -->
    <div id="partner-selection" class="step-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Stap 2: Kies je groepsgenoot</h5>

            <!-- Back button -->
            <button class="btn btn-outline-secondary btn-sm" onclick="window.history.back();">
                <i class="fas fa-arrow-left"></i> Terug naar groepen
            </button>
        </div>

        <div class="alert alert-info">
            <strong>Groep:</strong> {{ $groep->naam }}<br />
            <strong>Vak:</strong> {{ $groep->vak->naam ?? 'Onbekend vak' }}
        </div>

        <p class="text-muted">Selecteer de groepsgenoot die je wilt evalueren.</p>

        <div class="row">
            @forelse ($studenten as $student)
            <div class="col-md-4 mb-3">
                <div class="card border-success">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="fas fa-user-circle fa-3x text-success"></i>
                        </div>
                        <h6 class="card-title">{{ $student->name }}</h6>
                        <p class="card-text">
                            <small class="text-muted">{{ $student->email }}</small>
                        </p>
                        <a href="{{ route('evaluatie.start', ['evaluatie' => $groep->evaluatie_id, 'student' => $student->id, 'groep' => $groep->id]) }}"
                            class="btn btn-success btn-sm">
                            Evalueer {{ explode(' ', $student->name)[0] ?? $student->name }}
                        </a>


                    </div>
                </div>
            </div>
            @empty
            <p class="text-muted">Geen groepsgenoten beschikbaar om te evalueren.</p>
            @endforelse
        </div>
    </div>
</body>

</html>