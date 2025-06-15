@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <h2 class="page-title">Stap 1: Kies je groep</h2>

    @foreach ($groepen as $groep)
        <section class="section" aria-labelledby="beheer-evaluaties-title">
            <h4 id="beheer-evaluaties-title">{{ $groep->naam }}</h4>
            <p class="text-muted">
                <strong>Vak:</strong> {{ $groep->vak->naam }}
            </p>
            <p class="text-muted">
                <strong>Evaluatie:</strong> {{ $groep->evaluatie->titel }}
            </p>
            <p class="text-muted">
                <strong>Groepsleden:</strong> {{ count($groep->studenten) }}
            </p>
            <a href="{{ route('student.groep', ['groep' => $groep->id]) }}" class="btn btn-primary">Selecteer Groep</a>
        </section>
    @endforeach



@endsection