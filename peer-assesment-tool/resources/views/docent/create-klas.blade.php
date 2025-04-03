<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/js/create-klas.js'])
</head>

<body>
    <div class="container mt-5">
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
                    @foreach($vakken as $vak)
                        <option value=""></option>
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
                                <input class="file__import" id="inFileImport" type="file" class="form-control" name="inFileImport">
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
                    </div>
                </div>
            </section>

            <!-- Submit Button for Klas Creation -->
            <button type="submit" class="btn btn-primary mt-4">Create Klas</button>
        </form>
    </div>
</body>

</html>
