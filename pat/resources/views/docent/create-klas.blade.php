<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klas Aanmaken - Peer Beoordelingstool</title>
    @vite(['resources/js/app.js', 'resources/css/dashboard-docent.css'])
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
            background: linear-gradient(90deg, #00b09b, #96c93d);
            color: white;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

        main {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card {
            background: #fff;
            padding: 25px 20px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .card h2 {
            color: #00b09b;
            font-size: 1.4rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-column {
            margin-bottom: 20px;
        }

        .form-column label {
            display: block;
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .input-select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            font-size: 1rem;
            font-family: 'Poppins', sans-serif;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-sizing: border-box;
        }

        .input-select:focus {
            outline: none;
            border-color: #00b09b;
            box-shadow: 0 0 0 3px rgba(0, 176, 155, 0.1);
        }

        select.input-select[multiple] {
            min-height: 200px;
            resize: vertical;
        }

        .btn {
            display: inline-block;
            background: #00b09b;
            color: #fff;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }

        .btn:hover {
            background: #019180;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background-color: #fee;
            border: 1px solid #fcc;
            color: #c33;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .text-muted {
            color: #666;
            font-size: 0.85rem;
            margin-top: 5px;
            display: block;
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

        .btn-back {
            background: #ffffff40;
            color: #fff;
            border: none;
            padding: 10px 22px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 30px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 0 10px #0000001a;
            text-decoration: none;
            transition: background .3s ease;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="container" style="display: flex; align-items: center; justify-content: space-between; position: relative;">
            <h1>Klas Aanmaken <span class="user__voornaam">{{ auth()->user()->voornaam }}</span></h1>
            <a href="{{ route('docent.studentenbeheer') }}" class="btn-back">
                Back
            </a>
        </div>

    </header>

    <main class="container">

        <section class="card">
            <h2>Nieuwe Klas Aanmaken</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('docent.klas.store') }}">
                @csrf

                <!-- Klas name -->
                <div class="form-column">
                    <label for="inKlasNaam">Klas Naam</label>
                    <input id="inKlasNaam" type="text" name="naam" class="input-select" required>
                </div>

                <!-- Vak select -->
                <div class="form-column">
                    <label for="selVakId">Vak</label>
                    <select id="selVakId" name="vak_id" class="input-select" required>
                        <option value="">Selecteer een vak</option>
                        @foreach($vakken as $vak)
                            <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Student search + select -->
                <div class="form-column">
                    <label for="studentSearch">Studenten Zoeken</label>
                    <input type="text" id="studentSearch" class="input-select" placeholder="Zoek op naam of r_nummer...">
                </div>

                <div class="form-column">
                    <label for="studentSelect">Studenten Selecteren</label>
                    <select id="studentSelect" name="studenten[]" multiple class="input-select" required>
                        @foreach($studenten as $student)
                            <option value="{{ $student->id }}"
                                data-search="{{ strtolower($student->voornaam . ' ' . $student->achternaam . ' ' . $student->r_nummer) }}">
                                {{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->r_nummer }}) - {{ $student->email }}
                            </option>
                        @endforeach
                    </select>
                    <small class="text-muted">Houd Ctrl (Windows) of Cmd (Mac) ingedrukt om meerdere studenten te selecteren.</small>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn">Klas Aanmaken</button>
            </form>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('studentSearch');
            const select = document.getElementById('studentSelect');

            searchInput.addEventListener('input', function () {
                const term = this.value.trim().toLowerCase();
                Array.from(select.options).forEach(option => {
                    option.style.display = option.dataset.search.includes(term) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>