@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <h2 class="page-title">Stap 1: Kies je groep</h2>

        <div class="student-grid">
            @foreach ($groepen as $groep)
                <div class="student-card">
                    <h1 class="student-card-title2">
                        <strong>{{ $groep->naam }}</strong>
                    </h1>
                    <div class="student-card-body group-info">
                        <p class="text-muted"><strong>Vak:</strong> {{ $groep->vak->naam }}</p>
                        <p class="text-muted"><strong>Evaluatie:</strong> {{ $groep->evaluatie->titel }}</p>
                        <p class="text-muted"><strong>Groepsleden:</strong> {{ count($groep->studenten) }}</p>

                        <a href="{{ route('student.groep', ['groep' => $groep->id]) }}" class="btn">
                            Selecteer Groep
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection