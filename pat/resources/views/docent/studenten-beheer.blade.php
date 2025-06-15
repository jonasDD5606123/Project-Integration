<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Klas & Groups Management</title>
    @vite(['resources/js/app.js', 'resources/css/student-beheer.css'])

</head>

<body>

<header class="header" role="banner">
  <h1 class="title">
    <span class="user__voornaam">{{ auth()->user()->voornaam }}  {{ auth()->user()->achternaam }}</span>
  </h1>

  <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar home">← Terug</a>
</header>


  <main class="container" role="main">
    <h2>Klas &amp; Groups Management</h2>

    <section class="section" aria-labelledby="klas-users-title">
      <h4 id="klas-users-title">Create a Klas from Users</h4>
      <p class="text-muted">
        Select users from the system to create a new klas. Click the button below to start the process.
      </p>
      <a href="{{ route('docent.klas.create') }}" class="btn"><span class="emoji">👥</span> Create Klas from Users</a>
    </section>

    <section class="section" aria-labelledby="klas-import-title">
      <h4 id="klas-import-title">Create a Klas from Import</h4>
      <p class="text-muted">
        Import a klas and its students from a CSV or Excel file. Click the button below to upload your file.
      </p>
      <a href="{{ route('docent.klas.import') }}" class="btn"><span class="emoji">📂</span> Import Klas (CSV/Excel)</a>
    </section>

    <section class="section" aria-labelledby="groups-users-title">
      <h4 id="groups-users-title">Create Groups from System</h4>
      <p class="text-muted">
        Create groups by selecting students from the system. Click the button below to start grouping.
      </p>
      <a href="{{ route('docent.groepen.create') }}" class="btn"><span class="emoji">👥</span> Create Groups from Users</a>
    </section>

    <section class="section" aria-labelledby="groups-import-title">
      <h4 id="groups-import-title">Import Groups from File</h4>
      <p class="text-muted">
        Import groups from a CSV or Excel file. Click the button below to upload your groups file.
      </p>
      <a href="{{ route('docent.groepen.import') }}" class="btn"><span class="emoji">📂</span> Import Groups (CSV/Excel)</a>
    </section>

    <section class="section" aria-labelledby="groups-import-title">
      <h4 id="groups-import-title">Import Groups from File</h4>
      <p class="text-muted">
        Import groups from a CSV or Excel file. Click the button below to upload your groups file.
      </p>
      <a href="/klas/manage" class="btn"><span class="emoji">📂</span> Import Groups (CSV/Excel)</a>
    </section>
  </main>

</body>

</html>
