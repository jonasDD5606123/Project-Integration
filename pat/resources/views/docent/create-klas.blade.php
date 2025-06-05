<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Klas from Users</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
<div class="container mt-5">
    <a href="{{ route('docent.studentenbeheer') }}" class="btn btn-outline-secondary mb-3">Back</a>
    <h2 class="mb-4">Create Klas from Users</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('docent.klas.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Klas Name</label>
            <input id="inKlasNaam" type="text" class="form-control" name="naam" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Vak</label>
            <select id="selVakId" class="form-control" name="vak_id" required>
                <option value="">Select a vak</option>
                @foreach($vakken as $vak)
                    <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Search Students</label>
            <input type="text" id="studentSearch" class="form-control mb-2" placeholder="Search by name or r_nummer...">
            <label class="form-label">Select Students</label>
            <select class="form-control" id="studentSelect" name="studenten[]" multiple size="10" required>
                @foreach($studenten as $student)
                    <option value="{{ $student->id }}"
                        data-search="{{ strtolower($student->voornaam . ' ' . $student->achternaam . ' ' . $student->r_nummer) }}">
                        {{ $student->voornaam }} {{ $student->achternaam }} ({{ $student->r_nummer }}) - {{ $student->email }}
                    </option>
                @endforeach
            </select>
            <small class="text-muted">Hold Ctrl (Windows) or Cmd (Mac) to select multiple students.</small>
        </div>
        <button type="submit" class="btn btn-primary">Create Klas</button>
    </form>
</div>
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