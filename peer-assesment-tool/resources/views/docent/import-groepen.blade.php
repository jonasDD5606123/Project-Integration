<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Groepen Importeren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Importeer Groepen</h2>

       <form id="frmGroepen">
    @csrf
    <select id="selVakId" name="vak_id">
        @foreach ($vakken as $vak)
            <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
        @endforeach
    </select>

    <input type="file" id="inFileImport" />

    <table id="resultTable">
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

    <button type="submit">Importeer Groepen</button>
</form>

    </div>
</body>
</html>
