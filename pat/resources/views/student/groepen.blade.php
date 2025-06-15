@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Welcome to the dashboard</h2>
    <div class="container mt-4">

        <h2 class="mb-4 text-danger">Stap 1: Kies je groep</h2>
        <p class="text-muted">Selecteer de groep waarvoor je een evaluatie wilt invullen.</p>

        <div class="row">
            @foreach ($groepen as $groep)
                <div class="col-md-6 mb-3">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white">
                            {{ $groep->naam }}
                        </div>
                        <div class="card-body ">
                            <p class="card-text">
                                <strong>Vak:</strong> {{ $groep->vak->naam }}<br>
                                <strong>Evaluatie:</strong> {{ $groep->evaluatie->titel }}<br>
                                <strong>Groepsleden:</strong> {{ count($groep->studenten) }}
                            </p>
                            <a href="{{ route('student.groep', ['groep' => $groep->id]) }}" class="btn btn-danger btn-sm">
                                Selecteer Groep
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
