<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Klas & Groepen Beheer</title>
  @vite(['resources/js/app.js', 'resources/css/student-beheer.css'])
</head>

<body>

  <header class="header" role="banner">
    <h1 class="title">
      <span class="user__voornaam">{{ auth()->user()->voornaam }} {{ auth()->user()->achternaam }}</span>
    </h1>

    <div class="logout-form">
      <a href="{{ url('/') }}" class="btn-back" role="button" aria-label="Terug naar home">← Terug</a>
    </div>
  </header>

  <main class="container" role="main">
    <h2>Klas &amp; Groepen Beheer</h2>

    <section class="section" aria-labelledby="klas-users-title">
      <h4 id="klas-users-title">Maak een Klas aan vanuit Gebruikers</h4>
      <p class="text-muted">
        Selecteer gebruikers uit het systeem om een nieuwe klas aan te maken. Klik op de knop hieronder om te beginnen.
      </p>
      <a href="{{ route('docent.klas.create') }}" class="btn"><span class="emoji">👥</span> Maak Klas aan vanuit Gebruikers</a>
    </section>

    <section class="section" aria-labelledby="klas-import-title">
      <h4 id="klas-import-title">Maak een Klas aan via Import</h4>
      <p class="text-muted">
        Importeer een klas met leerlingen vanuit een CSV- of Excel-bestand. Klik op de knop hieronder om je bestand te uploaden.
      </p>
      <a href="{{ route('docent.klas.import') }}" class="btn"><span class="emoji">📂</span> Importeer Klas (CSV/Excel)</a>
    </section>

    <section class="section" aria-labelledby="groups-users-title">
      <h4 id="groups-users-title">Maak Groepen aan vanuit Systeem</h4>
      <p class="text-muted">
        Maak groepen aan door leerlingen uit het systeem te selecteren. Klik op de knop hieronder om te beginnen met groeperen.
      </p>
      <a href="{{ route('docent.groepen.create') }}" class="btn"><span class="emoji">👥</span> Maak Groepen aan vanuit Gebruikers</a>
    </section>

    <section class="section" aria-labelledby="groups-import-title">
      <h4 id="groups-import-title">Importeer Groepen vanuit Bestand</h4>
      <p class="text-muted">
        Importeer groepen vanuit een CSV- of Excel-bestand. Klik op de knop hieronder om je groepsbestand te uploaden.
      </p>
      <a href="{{ route('docent.groepen.import') }}" class="btn"><span class="emoji">📂</span> Importeer Groepen (CSV/Excel)</a>
    </section>

    <section class="section" aria-labelledby="classes-add-title">
      <h4 id="classes-add-title">Voeg Leerlingen toe aan Klas</h4>
      <p class="text-muted">
        Voeg leerlingen toe aan een klas met behulp van een CSV- of Excel-bestand. Klik op de knop hieronder om je leerlingenbestand te uploaden.
      </p>
      <a href="/klas/manage" class="btn"><span class="emoji">➕</span> Voeg Leerlingen toe</a>
    </section>

    <section class="section" aria-labelledby="subjects-management-title">
      <h4 id="subjects-management-title">Beheer Vakken</h4>
      <p class="text-muted">
        Hier kan je vakken toevoegen of beheren die worden gebruikt in je evaluaties. Klik op de knop hieronder om naar het vakkenbeheer te gaan.
      </p>
      <a href="/vakken" class="btn"><span class="emoji">📘</span> Vakkenbeheer</a>
    </section>
  </main>

</body>

</html>
