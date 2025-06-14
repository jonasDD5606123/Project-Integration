<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Beoordelingstool</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            margin: 0;
            padding: 0;
            background: #f9fafb;
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 0;
        }

        .header {
            position: relative;
            top: 0;
            background: linear-gradient(90deg, #00b09b, #96c93d);
            color: white;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 400;
        }

        .logout-form {
            position: absolute;
            top: 20px;
            right: 40px;
            display: flex;
            margin: auto 0;
            flex-direction: column;
            justify-content: center;
        }

        .btn-back {
            background: rgba(255 255 255 / 0.25);
            color: white;
            border: none;
            padding: 10px 22px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            transition: background 0.3s ease;
            user-select: none;
        }

        .btn-back:hover,
        .btn-back:focus {
            background: rgba(255 255 255 / 0.5);
            outline: none;
        }

        .btn {
            display: inline-block;
            background: #00b09b;
            color: #fff;
            padding: 12px 25px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background: #019180;
        }

        .btn-outline-secondary {
            background: transparent;
            color: #00b09b;
            border: 2px solid #00b09b;
        }

        .btn-outline-secondary:hover {
            background: #00b09b;
            color: white;
        }

        .btn-primary {
            background: #00b09b;
        }

        .btn-primary:hover {
            background: #019180;
        }

        .card {
            background: #fff;
            padding: 25px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        h2,
        h3,
        h4 {
            color: #00b09b;
            font-weight: 600;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
        }

        h3 {
            font-size: 1.4rem;
            margin-bottom: 20px;
        }

        h4 {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #00b09b;
            box-shadow: 0 0 0 3px rgba(0, 176, 155, 0.1);
        }

        .mb-3 {
            margin-bottom: 20px;
        }

        .mb-4 {
            margin-bottom: 30px;
        }

        .mt-4 {
            margin-top: 30px;
        }

        .mt-5 {
            margin-top: 40px;
        }

        .page {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .shadow-sm {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .p-4 {
            padding: 25px;
        }

        .border {
            border: 2px dashed #e1e5e9 !important;
            transition: border-color 0.3s ease;
        }

        .border:hover {
            border-color: #00b09b !important;
        }

        .rounded {
            border-radius: 10px;
        }

        .file__import {
            width: 100%;
            padding: 15px;
            font-size: 1rem;
            border: none;
            background: transparent;
            cursor: pointer;
        }

        .file__import::-webkit-file-upload-button {
            background: #00b09b;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            font-weight: 600;
            cursor: pointer;
            margin-right: 10px;
        }

        .file__import::-webkit-file-upload-button:hover {
            background: #019180;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e1e5e9;
        }

        .table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #333;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: rgba(0, 176, 155, 0.05);
        }

        .table-bordered {
            border: 1px solid #e1e5e9;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #e1e5e9;
        }

        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: text-bottom;
            border: 0.125em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border 0.75s linear infinite;
        }

        .spinner-border-sm {
            width: 0.875rem;
            height: 0.875rem;
            border-width: 0.125em;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        .me-2 {
            margin-right: 8px;
        }

        #feedback {
            margin: 20px 0;
            padding: 15px;
            border-radius: 10px;
            display: none;
        }

        #feedback.success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            display: block;
        }

        #feedback.error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            display: block;
        }

        .fas {
            margin-right: 5px;
        }

        .w-100 {
            width: 100%;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #00b09b;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #019180;
        }
    </style>
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
    @vite(['resources/js/create-klas.js'])
</body>

</html>