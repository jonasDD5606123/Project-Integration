<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klas & Groups Management</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container mt-5">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary mb-3">Back</a>
        <h2 class="mb-4">Klas & Groups Management</h2>

        <!-- Section: Create Klas from Users -->
        <div class="mb-4">
            <h4>Create a Klas from Users</h4>
            <p class="text-muted">Select users from the system to create a new klas. Click the button below to start the process.</p>
            <a href="{{ route('docent.klas.create') }}" class="btn btn-primary">Create Klas from Users</a>
        </div>

        <!-- Section: Create Klas from Import -->
        <div class="mb-4">
            <h4>Create a Klas from Import</h4>
            <p class="text-muted">Import a klas and its students from a CSV or Excel file. Click the button below to upload your file.</p>
            <a href="{{ route('docent.klas.import') }}" class="btn btn-primary">Import Klas (CSV/Excel)</a>
        </div>

        <!-- Section: Create Groups from System -->
        <div class="mb-4">
            <h4>Create Groups from System</h4>
            <p class="text-muted">Create groups by selecting students from the system. Click the button below to start grouping.</p>
            <a href="{{ route('docent.groepen.create') }}" class="btn btn-primary">Create Groups from Users</a>
        </div>

        <!-- Section: Import Groups from File -->
        <div class="mb-4">
            <h4>Import Groups from File</h4>
            <p class="text-muted">Import groups from a CSV or Excel file. Click the button below to upload your groups file.</p>
            <a href="{{ route('docent.groepen.import') }}" class="btn btn-primary">Import Groups (CSV/Excel)</a>
        </div>
    </div>
</body>
</html>