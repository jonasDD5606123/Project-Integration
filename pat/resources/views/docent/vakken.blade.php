<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Vakbeheer</title>
</head>

<body>
    <div class="container mt-4">
        <h1>Nieuw Vak Toevoegen</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('vakken.store') }}" method="POST" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="naam" class="form-label">Naam Vak</label>
                <input type="text" id="naam" name="naam" class="form-control" value="{{ old('naam') }}" required>
                @error('naam')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Vak Toevoegen</button>
        </form>

        <hr>

        <h2>Koppel jezelf aan een bestaand vak</h2>
        <form action="{{ route('vakken.link') }}" method="POST" class="mb-5">
            @csrf
            <div class="mb-3">
                <label for="vak_id" class="form-label">Selecteer vak</label>
                <select name="vak_id" id="vak_id" class="form-select" required>
                    <option value="">-- Kies een vak --</option>
                    @foreach($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
                @error('vak_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Koppel Vak</button>
        </form>

        <hr>

        <h2>Ontkoppel jezelf van een vak</h2>
        <form action="{{ route('vakken.unlink') }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <label for="unlink_vak_id" class="form-label">Selecteer vak om te ontkoppelen</label>
                <select name="vak_id" id="unlink_vak_id" class="form-select" required>
                    <option value="">-- Kies een vak --</option>
                    @foreach($userVakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
                @error('vak_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-danger">Ontkoppel Vak</button>
        </form>
    </div>
</body>

</html>
