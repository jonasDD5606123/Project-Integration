<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Peer Evaluation & Activities</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite(['resources/js/app.js', 'resources/css/app.css', 'resources/js/create-evaluatie.js', 'resources/css/kanban.css'])

    <style>
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-glass {
            background: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            width: 100%;
            max-width: 600px;
            color: #111827;
        }

        .form-control {
            background-color: #f9fafb;
            border: 1px solid #d1d5db;
            color: #111827;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #10b981;
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }

        .btn-custom {
            background-color: #10b981;
            color: #fff;
            font-weight: bold;
            border-radius: 0.5rem;
        }

        .btn-custom:hover {
            background-color: #059669;
        }

        .form-label {
            font-weight: 500;
        }

        .text-danger {
            font-size: 0.875rem;
            color: #dc2626;
        }

        .btn-outline-secondary {
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="card-glass">
        <a href="{{ route('docent.evaluatie') }}" class="btn btn-outline-secondary">← Back</a>
        <h2 class="mb-4 text-center">Create Evaluation</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form>
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input id="inTitle" type="text" class="form-control" name="titel" placeholder="Evaluation Title">
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea id="inDesc" class="form-control" name="beschrijving" placeholder="Describe the evaluation..."></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Deadline</label>
                <input id="inDeadline" type="datetime-local" class="form-control" name="deadline">
            </div>

            <div class="mb-3">
                <label class="form-label">Vak</label>
                <select id="selVakId" class="form-control" name="vak_id" required>
                    <option value="">Selecteer een vak</option>
                    @foreach ($vakken as $vak)
                    <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
            </div>

            <div id="criteriaContainer"></div>
            <button id="btnAddCriterium" type="button" class="btn btn-secondary mb-3">Add Criterium</button>
            <button id="btnSubmit" type="submit" class="btn btn-custom w-100">Create Evaluation</button>
        </form>
        <div id="feedback" class="mt-3"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>