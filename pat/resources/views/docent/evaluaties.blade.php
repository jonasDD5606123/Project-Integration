<div class="container mt-5">
    <h2>Evaluaties</h2>

    <!-- Filter Form -->
    <form method="GET" class="mb-4">
        <label for="vak_id">Filter op vak:</label>
        <select name="vak_id" id="vak_id" onchange="this.form.submit()">
            <option value="">-- Alle vakken --</option>
            @foreach($vakken as $vak)
                <option value="{{ $vak->id }}" {{ request('vak_id') == $vak->id ? 'selected' : '' }}>
                    {{ $vak->naam }}
                </option>
            @endforeach
        </select>
    </form>

    <!-- Evaluations Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Vak</th>
                <th>Deadline</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @forelse($evaluaties as $evaluatie)
                <tr>
                    <td>{{ $evaluatie->titel }}</td>
                    <td>{{ $evaluatie->vak->naam ?? '-' }}</td>
                    <td>{{ $evaluatie->deadline }}</td>
                    <td>
                        <a href="{{ route('evaluatie.groepen', $evaluatie->id) }}" class="btn btn-sm btn-info">Bekijken</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-muted">Geen evaluaties gevonden.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>