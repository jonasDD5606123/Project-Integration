<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Groups</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Import Groups</h2>
        
        <form method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- File Upload Input -->
            <div class="mb-3">
                <label for="file" class="form-label">Upload Excel File</label>
                <input type="file" class="form-control" name="file" id="file" required>
            </div>
            
            <!-- Vak (Subject) Dropdown -->
            <div class="mb-3">
                <label for="vak" class="form-label">Vak (Subject)</label>
                <select id="vak" class="form-control" name="vak_id" required>
                    <option value="">Select Vak</option>
                    @foreach($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Klas (Class) Dropdown -->
            <div class="mb-3">
                <label for="klas" class="form-label">Klas (Class)</label>
                <select id="klas" class="form-control" name="klas_id" required>
                    <option value="">Select Klas</option>
                    @foreach($klassen as $klas)
                        <option value="{{ $klas->id }}">{{ $klas->naam }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Peer Assessment Selection -->
            <div class="mb-3">
                <label for="peer_assessment" class="form-label">Peer Assessment</label>
                <select id="peer_assessment" class="form-control" name="peer_assessment" required>
                    <option value="">Select Option</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary mb-3">Import</button>
        </form>
    </div>
</body>
</html>
