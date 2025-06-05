<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Evaluation & Activities</title>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container mt-5">
        <a href="{{ url('/') }}" class="btn btn-outline-secondary mb-3">Back</a>
        <h2 class="mb-4">Evaluations</h2>

        <!-- Section: Add New Evaluation -->
        <div class="mb-4">
            <h4>Add a New Evaluation</h4>
            <p class="text-muted">Create a new evaluation for your course. Click the button below to start a new evaluation and define its criteria.</p>
            <a href="{{ route('docent.evaluatie.create') }}" class="btn btn-primary">Add New Evaluation</a>
        </div>

        <!-- Section: Existing Evaluations -->
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0">Existing Evaluations</h4>
                <p class="text-muted mb-0">Below you find all evaluations you have created for your courses. You can edit each evaluation using the button provided.</p>
            </div>
            <ul class="list-group list-group-flush">
                @forelse($evaluaties as $evaluatie)
                    <li class="list-group-item">
                        <strong>{{ $evaluatie->titel }}</strong>
                        <span class="text-muted">({{ $evaluatie->deadline }})</span>
                        <br>
                        <span class="text-secondary">Vak: {{ $evaluatie->vak->naam ?? '-' }}</span>
                        <br>
                        {{ $evaluatie->beschrijving }}
                        <br>
                        <a href="{{ route('docent.evaluatie.edit', $evaluatie->id) }}" class="btn btn-sm btn-warning mt-2">Edit</a>
                    </li>
                @empty
                    <li class="list-group-item text-muted">No evaluations found.</li>
                @endforelse
            </ul>
        </div>
    </div>
</body>

</html>