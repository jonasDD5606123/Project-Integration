<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Groepen Importeren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/import-groepen.js', 'resources/css/app.css'])
</head>
<body class="bg-light-gray">
    <div class="card-container">
        <h2 class="heading-primary">Importeer Groepen</h2>

        <form id="frmGroepen" class="form-column">
            @csrf
            <select id="selVakId" name="vak_id" class="input-select">
                @foreach ($vakken as $vak)
                    <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                @endforeach
            </select>

            <input type="file" id="inFileImport" class="input-file" />

            <table id="resultTable" class="table-styled">
                <thead>
                    <tr>
                        <th>Groep</th>
                        <th>User ID</th>
                        <th>Voornaam</th>
                        <th>Achternaam</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <button type="submit" class="btn-primary">Importeer Groepen</button>
        </form>
    </div>
</body>
</html>
