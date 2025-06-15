<h1>Evaluaties - Mijn Groepen</h1>

<table border="1" cellpadding="6" cellspacing="0">
    <thead>
        <tr>
            <th>Evaluatie</th>
            <th>Vak</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Scores gegeven</th>
            <th>Scores verwacht</th>
        </tr>
    </thead>
    <tbody>
        @forelse($evaluaties as $item)
            <tr>
                <td>{{ $item['evaluatie']->titel ?? 'Evaluatie '.$item['evaluatie']->id }}</td>
                <td>{{ $item['evaluatie']->vak->naam ?? '-' }}</td>
                <td>
                    {{ $item['evaluatie']->deadline ? $item['evaluatie']->deadline->format('d-m-Y H:i:s') : '-' }}
                </td>
                <td>
                    @if($item['volledig'])
                        Voltooid
                    @elseif($item['deadlinePassed'])
                        Te laat
                    @else
                        Open
                    @endif
                </td>
                <td>{{ $item['aantalScoresByStudent'] }}</td>
                <td>{{ $item['verwachteScoresPerStudent'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Geen evaluaties gevonden.</td>
            </tr>
        @endforelse
    </tbody>
</table>