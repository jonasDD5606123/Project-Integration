<h1>Evaluaties - Mijn Groepen</h1>

<form method="GET">
    <label for="vak_id">Vak:</label>
    <select name="vak_id" id="vak_id" onchange="this.form.submit()">
        <option value="">-- Alle vakken --</option>
        @foreach($vakken as $vak)
            <option value="{{ $vak->id }}" {{ $selectedVak == $vak->id ? 'selected' : '' }}>
                {{ $vak->naam }}
            </option>
        @endforeach
    </select>

    <label for="evaluatie_id">Evaluatie:</label>
    <select name="evaluatie_id" id="evaluatie_id" onchange="this.form.submit()">
        <option value="">-- Alle evaluaties --</option>
        @foreach($vakken as $vak)
            @foreach($vak->evaluaties as $evaluatie)
                <option value="{{ $evaluatie->id }}" {{ $selectedEvaluatie == $evaluatie->id ? 'selected' : '' }}>
                    {{ $evaluatie->naam ?? 'Evaluatie '.$evaluatie->id }}
                </option>
            @endforeach
        @endforeach
    </select>
</form>

<table>
    <thead>
        <tr>
            <th>Groep</th>
            <th>Vak</th>
            <th>Evaluatie</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groepen as $groep)
            <tr>
                <td>{{ $groep->naam }}</td>
                <td>{{ $groep->vak->naam ?? '' }}</td>
                <td>{{ $groep->evaluatie->naam ?? $groep->evaluatie->id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>