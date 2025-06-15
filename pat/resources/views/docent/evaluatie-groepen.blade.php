<div class="container mt-5">
    <h2>Groepen voor evaluatie: {{ $evaluatie->titel }}</h2>
    <a href="" class="btn btn-secondary mb-3">Terug naar evaluaties</a>
    <a href="{{ route('evaluatie.export', $evaluatie->id) }}" class="btn btn-success mb-3">
        Download Excel
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Groepnaam</th>
                <th>Vak</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse($evaluatie->groepen as $groep)
            <tr>
                <td>{{ $groep->naam }}</td>
                <td>{{ $groep->vak->naam ?? '-' }}</td>
                <td>
                    <a href="{{ route('evaluatie.resultaten', [$evaluatie->id, $groep->id]) }}" class="btn btn-sm btn-info">
                        Bekijk resultaten
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-muted">Geen groepen gevonden voor deze evaluatie.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>