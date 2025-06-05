<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Evaluation</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div class="container mt-5">
    <a href="{{ route('docent.evaluatie') }}" class="btn btn-outline-secondary mb-3">Back</a>
    <h2>Edit Evaluation</h2>
    <form method="POST" action="{{ route('evaluatie.update', $evaluatie->id) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="titel" value="{{ $evaluatie->titel }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="beschrijving">{{ $evaluatie->beschrijving }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="datetime-local" class="form-control" name="deadline" value="{{ $evaluatie->deadline->format('Y-m-d\TH:i') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Vak</label>
            <select class="form-control" name="vak_id">
                @foreach($vakken as $vak)
                    <option value="{{ $vak->id }}" @if($vak->id == $evaluatie->vak_id) selected @endif>{{ $vak->naam }}</option>
                @endforeach
            </select>
        </div>
        {{-- ...bestaande criteria... --}}
        @foreach($evaluatie->criteria as $i => $criterium)
            <div class="mb-3 border rounded p-2 criterium-group">
                <label class="form-label">Criterium</label>
                <input type="text" class="form-control" name="criteria[{{ $i }}][criterium]" value="{{ $criterium->criterium }}">
                <label class="form-label mt-2">Min Value</label>
                <input type="number" class="form-control" name="criteria[{{ $i }}][min_waarde]" value="{{ $criterium->min_waarde }}">
                <label class="form-label mt-2">Max Value</label>
                <input type="number" class="form-control" name="criteria[{{ $i }}][max_waarde]" value="{{ $criterium->max_waarde }}">
                <input type="hidden" name="criteria[{{ $i }}][id]" value="{{ $criterium->id }}">
                <button type="button" class="btn btn-danger btnRemoveCriterium mt-2">Verwijder</button>
            </div>
        @endforeach

        {{-- Container voor nieuwe criteria --}}
        <div id="criteriaContainer"></div>
        <button id="btnAddCriterium" type="button" class="btn btn-secondary mb-3">Criterium toevoegen</button>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<script>
    window.criteriaNextIndex = {{ count($evaluatie->criteria) }};
</script>
@vite(['resources/js/edit-evaluatie.js'])
</body>
</html>