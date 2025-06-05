<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Overzicht van Groepen</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="p-4">
    <div class="container kanban">
        <h2 id="groupTitle"></h2>
        <ul id="studentList" class="list-group mt-3"></ul>
        <a href="{{ route('groepen.index') }}" class="btn btn-secondary mt-4">Terug naar overzicht</a>
    </div>
</body>

</html>