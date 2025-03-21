<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
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
                <li class="nav-item"><a class="nav-link active" href="/docent">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Peer Evaluatie</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/klassen">Klassen</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/cursussen">cursussen</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/studenten">Studenten</a></li>
                <li class="nav-item"><a class="nav-link" href="/docent/file">Importing</a></li>
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
    <div class="container mt-4">
        <main class="mt-4">
            <section id="cursussen" class="page mt-4">
                <h2>Studenten</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card p-3 shadow">
                            <h3>Student Toevoegen</h3>
                            <p>Geen beschrijving beschikbaar</p>
                            <button class="btn btn-primary"><a class="nav-link" href="/docent/studenten">Klassen</a></button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card p-3 shadow">
                            <h3>Groep Toevoegen</h3>
                            <p>Geen beschrijving beschikbaar</p>
                            <button class="btn btn-primary"><a class="nav-link" href="/docent/klassen">Klassen</a></button>
                        </div>
                    </div>
                </div>
            </section>
            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Peer Evaluatie</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Peer Evaluatie Toevoegen</h3>

                    <p class="card-text mb-3">
                        vragen en deadline toevoegen
                    </p>

                    <div class="d-flex justify-content-end mt-3 ">
                        <button class="btn btn-primary px-4 py-2">Bekijk meer Details</button>
                    </div>
                </div>
            </section>

            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">Klassen</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Klas Toevoegen</h3>

                    <p class="card-text mb-3">
                        Geen beschrijving beschikbaar
                    </p>

                    <div class="d-flex justify-content-end mt-3 ">
                        <button class="btn btn-primary px-4 py-2"><a class="nav-link" href="/docent/klassen">Klassen</a></button>
                    </div>
                </div>
            </section>

            <section id="beoordelingen" class="page mt-4">
                <h2 class="mb-4 text-start">cursussen</h2>

                <div class="card p-4 bg-light border-0 shadow-sm">
                    <h3 class="card-title text-primary">Cursus Toevoegen</h3>

                    <p class="card-text mb-3">
                        Geen beschrijving beschikbaar
                    </p>

                    <div class="d-flex justify-content-end mt-3 ">
                        <button class="btn btn-primary px-4 py-2"><a class="nav-link" href="/docent/cursussen">cursussen</a></button>
                    </div>
                </div>
            </section>

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
                                    <button class="btn btn-primary">Browse Files</button>
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
                                    <button class="btn btn-primary">Browse Files</button>
                                </div>
                                <a href="#" class="d-block mt-2">Download Template</a>
                            </div>
                        </section>
                    </div>
                </div>
            </div>




            <section id="resultaten" class="page mt-4">
                <h2>Ingevulde Studenten</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>user id</th>
                            <th>voornaam</th>
                            <th>familienaam</th>
                            <th>email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>q0448776</td>
                            <td>Chee Chung</td>
                            <td>Lum</td>
                            <td>cheechung.lum@student.odisee.be</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>q0504281</td>
                            <td>Sam</td>
                            <td>Lombaert</td>
                            <td>sam.delombaert@student.odisee.be</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>q0768961</td>
                            <td>Roman</td>
                            <td>Bereznev</td>
                            <td>roman.bereznev@student.odisee.be</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>q1275557</td>
                            <td>Elodie</td>
                            <td>Cannon</td>
                            <td>elodie.cannon@student.odisee.be</td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr>
                            <td>q1231099</td>
                            <td>Sergon</td>
                            <td>Begtas</td>
                            <td>sergon.begtas@student.odisee.be</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </main>
    </div>
    <footer class="text-center bg-primary text-white py-2 mt-4">
        <p class="mb-0">&copy; 2025 Peer Beoordelingstool</p>
    </footer>
</body>

</html>