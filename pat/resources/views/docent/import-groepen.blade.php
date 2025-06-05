<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Groepen Importeren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/import-groepen.css', 'resources/js/app.js'])
</head>
<body class="bg-light-gray">
    <div class="card-container">
        <a href="{{ route('docent.studentenbeheer') }}" class="btn btn-outline-secondary mb-3">
            <i class="bi bi-arrow-left"></i> back
        </a>
        <h2 class="heading-primary">Importeer Groepen</h2>

        <form id="frmGroepen" class="form-column">
            @csrf

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <select id="selVakId" name="vak_id" class="input-select" onchange="this.form.submit()">
                @foreach ($vakken as $vak)
                    <option value="{{ $vak->id }}" {{ request('vak_id') == $vak->id ? 'selected' : '' }}>
                        {{ $vak->naam }}
                    </option>
                @endforeach
            </select>

            <select id="selEvaluatieId" name="evaluatie_id" class="input-select">
                @foreach ($evaluaties as $evaluatie)
                    <option value="{{ $evaluatie->id }}" {{ request('evaluatie_id') == $evaluatie->id ? 'selected' : '' }}>
                        {{ $evaluatie->titel }}
                    </option>
                @endforeach
            </select>

            <input type="file" id="inFileImport" class="file__import" />

            <table id="resultTable" class="table-styled">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button type="submit" class="btn-primary">
                <span class="spinner-border spinner-border-sm me-2 d-none" id="importSpinner" role="status" aria-hidden="true"></span>
                Importeer Groepen
            </button>
        </form>
        <div id="feedback"></div>
    </div>
    @vite(['resources/js/import-groepen.js'])
</body>
</html>