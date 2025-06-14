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

            <a href="{{ route('docent.studentenbeheer') }}" class="btn-back">Back</a>
        </div>
    </header>

    <main class="container">
        <h2 class="mb-4">Create Klas</h2>

        <!-- Combined form for klas creation and student import -->
        <form id="frmKlas" enctype="multipart/form-data">
            @csrf

            <!-- Klas Name -->
            <div class="mb-3">
                <label class="form-label">Klas Name</label>
                <input id="inKlasNaam" type="text" class="form-control" name="naam">
            </div>

            <!-- Vak Selection -->
            <div class="mb-3">
                <label class="form-label">Vak</label>
                <select id="selVakId" class="form-control" name="vak_id">
                    <option value="">Select a vak</option>
                    @foreach ($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Import Students Section -->
            <section id="studenten" class="page w-100 mt-4">
                <h3>Importeer Studenten</h3>
                <div class="card p-4 shadow-sm">
                    <div class="row">
                        <!-- File Upload Column -->
                        <div class="col-md-6">
                            <h4><i class="fas fa-user-graduate"></i> Import Students</h4>
                            <p>Import students from Excel file (.xlsx, .csv)</p>
                            <div class="border p-4 rounded mb-3">
                                <label for="inFileImport" class="form-label">
                                    <span class="fas fa-upload">&#128193;</span> Choose File
                                </label>
                                <input class="file__import" id="inFileImport" type="file" class="form-control"
                                    name="inFileImport">
                            </div>
                        </div>

                        <!-- Table Column -->
                        <div class="col-md-6">
                            <div class="table-responsive table__container">
                                <table id="resultTable" class="table table-striped table-bordered mx-auto">
                                    <thead>
                                        <!-- Add table headers if needed -->
                                    </thead>
                                    <tbody>
                                        <!-- Table rows will be inserted here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="import-feedback"></div>

                    </div>
                </div>
            </section>

            <!-- Feedback Section -->
            <div id="feedback"></div>

            <!-- Submit Button for Klas Creation -->
            <button type="submit" class="btn btn-primary mt-4" id="submitBtn">
                <span id="submitBtnSpinner" class="spinner-border spinner-border-sm me-2" style="display:none;"
                    role="status" aria-hidden="true"></span>
                <span id="submitBtnText">Create Klas</span>
            </button>
        </form>
    </main>
</body>

</html>