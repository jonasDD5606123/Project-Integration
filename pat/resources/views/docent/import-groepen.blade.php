<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Groepen Importeren</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js', 'resources/js/import-groepen.js', 'resources/css/import-klas.css'])
</head>
<body>
    <header class="header">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; position: relative;">
            <h1>Groepen Importeren <span class="user__voornaam">{{ auth()->user()->voornaam ?? 'Docent' }}</span></h1>
            <a href="{{ route('docent.studentenbeheer') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Terug</a>
        </div>
    </header>

    <main class="container">
        <h2 class="mb-4">Selecteer vak en evaluatie</h2>

        <form id="frmGroepen" class="w-100" enctype="multipart/form-data">
            @csrf

            <!-- Vak & Evaluatie selectie -->
            <div class="mb-3">
                <label class="form-label">Vak</label>
                <select id="selVakId" name="vak_id" class="form-control" onchange="this.form.submit()">
                    @foreach ($vakken as $vak)
                        <option value="{{ $vak->id }}" {{ request('vak_id') == $vak->id ? 'selected' : '' }}>
                            {{ $vak->naam }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Evaluatie</label>
                <select id="selEvaluatieId" name="evaluatie_id" class="form-control">
                    @foreach ($evaluaties as $evaluatie)
                        <option value="{{ $evaluatie->id }}" {{ request('evaluatie_id') == $evaluatie->id ? 'selected' : '' }}>
                            {{ $evaluatie->titel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Upload & Tabel -->
            <section class="page w-100 mt-4">
                <h3>Importeer Groepen</h3>
                <div class="card p-4 shadow-sm">
                    <div class="row">
                        <!-- File Upload -->
                        <div class="col-md-6">
                            <h4><i class="fas fa-users"></i> Upload Groepen</h4>
                            <p>Upload een Excel-bestand (.xlsx of .csv)</p>
                            <div class="border p-4 rounded mb-3">
                                <label for="inFileImport" class="form-label">
                                    <span class="fas fa-upload">&#128193;</span> Kies een bestand
                                </label>
                                <input type="file" id="inFileImport" class="file__import" name="import_file">
                            </div>
                        </div>

                        <!-- Voorbeeldtabel -->
                            <div class="table-responsive table__container">
                                <table id="resultTable" class="table table-striped table-bordered mx-auto">
                                    <thead></thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                        <div id="import-feedback" class="w-100"></div>
                    </div>
                </div>
            </section>

            <!-- Feedback -->
            <div id="feedback"></div>

            <!-- Submit knop -->
            <button type="submit" class="btn btn-primary mt-4">
                <span class="spinner-border spinner-border-sm me-2 d-none" id="importSpinner" role="status" aria-hidden="true"></span>
                Importeer Groepen
            </button>
        </form>
    </main>
</body>
</html>
