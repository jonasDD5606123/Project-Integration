<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['resources/js/app.js', 'resources/js/create-klas.js' , 'resources/css/import-klas.css'])
</head>

<body>
    <header class="header">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; position: relative;">
            <h1>Klas Aanmaken <span class="user__voornaam">{{ auth()->user()->voornaam ?? 'Docent' }}</span></h1>

            <a href="{{ route('docent.studentenbeheer') }}" class="btn-back">Terug</a>
        </div>
    </header>

    <main class="container">
        <h2 class="mb-4">Klas Aanmaken</h2>

        <!-- Gecombineerd formulier voor klas aanmaken en studenten importeren -->
        <form id="frmKlas" enctype="multipart/form-data">
            @csrf

            <!-- Klas Naam -->
            <div class="mb-3">
                <label class="form-label">Klas Naam</label>
                <input id="inKlasNaam" type="text" class="form-control" name="naam" placeholder="Vul de klasnaam in">
            </div>

            <!-- Vak Selectie -->
            <div class="mb-3">
                <label class="form-label">Vak</label>
                <select id="selVakId" class="form-control" name="vak_id">
                    <option value="">Selecteer een vak</option>
                    @foreach ($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Studenten Import Sectie -->
            <section id="studenten" class="page w-100 mt-4">
                <h3>Studenten Importeren</h3>
                <div class="card p-4 shadow-sm">
                    <div class="row">
                        <!-- Bestand Upload Kolom -->
                        <div class="col-md-6">
                            <h4><i class="fas fa-user-graduate"></i> Studenten Importeren</h4>
                            <p>Importeer studenten vanuit een Excel-bestand (.xlsx, .csv)</p>
                            <div class="border p-4 rounded mb-3">
                                <label for="inFileImport" class="form-label">
                                    <span class="fas fa-upload">&#128193;</span> Kies Bestand
                                </label>
                                <input class="file__import" id="inFileImport" type="file" class="form-control"
                                    name="inFileImport" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            </div>
                        </div>

                        <!-- Tabel Kolom -->
                        <div class="col-md-6">
                            <div class="table-responsive table__container">
                                <table id="resultTable" class="table table-striped table-bordered mx-auto">
                                    <thead>
                                        <!-- Voeg hier eventueel kolomkoppen toe -->
                                    </thead>
                                    <tbody>
                                        <!-- Tabelrijen worden hier toegevoegd -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="import-feedback"></div>

                    </div>
                </div>
            </section>

            <!-- Feedback Sectie -->
            <div id="feedback"></div>

            <!-- Verzenden knop voor klas aanmaken -->
            <button type="submit" class="btn btn-primary mt-4" id="submitBtn">
                <span id="submitBtnSpinner" class="spinner-border spinner-border-sm me-2" style="display:none;"
                    role="status" aria-hidden="true"></span>
                <span id="submitBtnText">Klas Aanmaken</span>
            </button>
        </form>
    </main>
</body>

</html>
