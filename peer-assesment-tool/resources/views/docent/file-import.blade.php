<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/js/imports.js'])
    <!-- Bootstrap CSS via CDN -->
</head>

<body>
    <header class="bg-primary text-white py-3 ps-3">
        <h1 class="mb-0">
            Welkom <span class="user__voornaam">Mohammed</span>
        </h1>
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="/docent">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Peer Evaluatie</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/klassen">Klassen</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/cursussen">cursussen</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/studenten">Studenten</a></li>
                <li class="nav-item"><a class="nav-link active" href="/docent/file">Importing</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link"
                            style="text-decoration: none;">Afmelden</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="container page mt-4">
            <h2>Importing</h2>
            <div class="row">
                <div class="col-md-6">
                    <section id="studenten" class="page">
                        <h3>Importeer Studenten</h3>
                        <div class="card p-4 shadow text-center">
                            <h4><i class="fas fa-user-graduate"></i> Import Students</h4>
                            <p>Import students from Excel file (.xlsx, .csv)</p>
                            <div class="border p-4 rounded" style="border: 2px dashed #ccc;">
                                <p><span class="fas fa-upload">&#128193;</span> Drag & Drop or Click to Upload</p>
                                <form id="frmFileImport">
                                    <p>
                                        <input type="file" id="inFileImport" name="inFileImport">
                                    </p>
                                    <p>
                                        <button type="submit" id="btnFileImportSubmit" name="btnFileImportSubmit">submit</button>
                                    </p>
                                </form>
                            </div>
                            <a href="#" class="d-block mt-2">Download Template</a>
                        </div>
                    </section>
                </div>

                <div class="col-md-6">
                    <section id="groepen" class="page">
                        <h3>Importeer Groepen</h3>
                        <div class="card p-4 shadow text-center">
                            <h4><i class="fas fa-users"></i> Import Groups</h4>
                            <p>Import groups from Excel file (.xlsx, .csv)</p>
                            <div class="border p-4 rounded" style="border: 2px dashed #ccc;">
                                <p><span class="fas fa-upload">&#128193;</span> Drag & Drop or Click to Upload</p>
                                <form id="frmFileImport">
                                    <p>
                                        <input type="file" id="inFileImport" name="inFileImport">
                                    </p>
                                    <p>
                                        <button type="submit" id="btnFileImportSubmit" name="btnFileImportSubmit">submit</button>
                                    </p>
                                </form>
                            </div>
                            <a href="#" class="d-block mt-2">Download Template</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>

    </main>

    <footer class="text-center bg-primary text-white py-2 mt-4">
        <p class="mb-0">&copy; 2025 Peer Beoordelingstool</p>
    </footer>
</body>

</html>
