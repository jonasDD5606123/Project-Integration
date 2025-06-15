    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Groepsgenoten Evaluatie</title>
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>

    <body>
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-danger">Stap 2: Kies je groepsgenoot</h2>
                <a class="btn btn-outline-secondary btn-sm" href="{{ url()->previous() }}">
                    <i class="fas fa-arrow-left"></i> Terug naar groepen
                </a>
            </div>

            <div class="alert alert-danger">
                <strong>Groep:</strong> {{ $groep->naam }}<br>
                <strong>Vak:</strong> {{ $groep->vak->naam ?? 'Onbekend vak' }}
            </div>

            <p class="text-muted">Selecteer de groepsgenoot die je wilt evalueren.</p>

            <div class="row">
                @forelse ($studenten as $student)
                <div class="col-md-4 mb-3">
                    <div class="card border-danger text-center h-100">
                        <div class="card-header bg-danger text-white">
                            <i class="fas fa-user-circle fa-2x"></i>
                        </div>
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $student->name }}</h5>
                                <p class="card-text">
                                    <small class="text-muted">{{ $student->email }}</small>
                                </p>
                            </div>

                            @php
                            $isFullyEvaluated = in_array($student->id, $fullyEvaluatedStudentIds ?? []);
                            @endphp

                            <a href="{{ route('evaluatie.start', ['evaluatie' => $groep->evaluatie_id, 'student' => $student->id, 'groep' => $groep->id]) }}"
                                class="btn {{ $isFullyEvaluated ? 'btn-success' : 'btn-danger' }} btn-sm mt-3">
                                @if ($isFullyEvaluated)
                                <i class="fas fa-check-circle"></i> Evaluatie bewerken
                                @else
                                Evalueer {{ explode(' ', $student->name)[0] ?? $student->name }}
                                @endif
                            </a>

                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-muted">Geen groepsgenoten beschikbaar om te evalueren.</p>
                </div>
                @endforelse
            </div>
        </div>
    </body>

    </html>