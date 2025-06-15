@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="page-content">
        <div class="page-header">
            <h2 class="page-title">Stap 2: Kies je groepsgenoot</h2>
            <a href="{{ url()->previous() }}" class="btn-back">← Terug naar groepen</a>
        </div>


        <section class="section" aria-labelledby="beheer-evaluaties-title">
            <p class="text-muted">
                <strong>Groep:</strong> {{ $groep->naam }}
            </p>
            <p class="text-muted">
                <strong>Evaluatie:</strong> {{ $groep->evaluatie->titel ?? 'Onbekende evaluatie' }}
            </p>
            <p class="text-muted">
                <strong>Vak:</strong> {{ $groep->vak->naam ?? 'Onbekend vak' }}
            </p>
        </section>
        <p class="section-note">Selecteer de groepsgenoot die je wilt evalueren.</p>

        <div class="student-grid">
            @forelse ($studenten as $student)
                @php
                    $isFullyEvaluated = in_array($student->id, $fullyEvaluatedStudentIds ?? []);
                @endphp
                <div class="student-card">

                    <div class="student-card-body">
                        <h4>{{ $student->name }}</h4>
                        <p class="student-email">{{ $student->email }}</p>
                        <a href="{{ route('evaluatie.start', ['evaluatie' => $groep->evaluatie_id, 'student' => $student->id, 'groep' => $groep->id]) }}"
                            class="btn {{ $isFullyEvaluated ? 'btn-success' : 'btn-danger' }}">
                            @if ($isFullyEvaluated)
                                ✅ Evaluatie bewerken
                            @else
                                Evalueer {{ explode(' ', $student->name)[0] ?? $student->name }}
                            @endif
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted">Geen groepsgenoten beschikbaar om te evalueren.</p>
            @endforelse
        </div>
    </main>
@endsection




</body>

</html>