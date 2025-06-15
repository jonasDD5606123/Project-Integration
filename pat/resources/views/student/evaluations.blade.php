@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h2>Evaluaties</h2>

        @if(count($evaluaties))
            <div class="dashboard-grid">
                @foreach($evaluaties as $item)
                    <div class="section">
                        <h4>{{ $item['evaluatie']->titel ?? 'Evaluatie ' . $item['evaluatie']->id }}</h4>
                        <p class="text-muted"><strong>Vak:</strong> {{ $item['evaluatie']->vak->naam ?? '-' }}</p>
                        <p class="text-muted"><strong>Deadline:</strong>
                            {{ $item['evaluatie']->deadline ? $item['evaluatie']->deadline->format('d-m-Y H:i') : '-' }}
                        </p>
                        <p class="text-muted">
                            <strong>Status:</strong>
                            @if($item['volledig'])
                                <span class="status success">Voltooid</span>
                            @elseif($item['deadlinePassed'])
                                <span class="status danger">Te laat</span>
                            @else
                                <span class="status warning">Open</span>
                            @endif
                        </p>
                        <p class="text-muted"><strong>Scores gegeven:</strong> {{ $item['aantalScoresByStudent'] }}</p>
                        <p class="text-muted"><strong>Scores verwacht:</strong> {{ $item['verwachteScoresPerStudent'] }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert-box">
                Geen evaluaties gevonden.
            </div>
        @endif
    </div>
@endsection