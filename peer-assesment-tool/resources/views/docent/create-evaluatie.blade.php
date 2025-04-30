<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peer Evaluation & Activities</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css', 'resources/js/create-evaluatie.js'])
</head>
<body>
  <div class="container mt-5">
        <h2 class="mb-4">Create Evaluation</h2>
        <form>
            @csrf
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input id="inTitle" type="text" class="form-control" name="titel">
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea id="inDesc" class="form-control" name="beschrijving"></textarea>
            </div>
            <div class="mb-3">
    <label class="form-label">Deadline</label>
    <input id="inDeadline" type="datetime-local" class="form-control" name="deadline">
</div>

            <div class="mb-3">
                <label class="form-label">Vak</label>
                <select id="selVakId" class="form-control" name="vak_id" required>
                <option value=""></option>
                    @foreach($vakken as $vak)
                        <option value="{{ $vak->id }}">{{ $vak->naam }}</option>
                    @endforeach
                </select>
            </div>
            
            <div id="criteriaContainer"></div>
            <button id="btnAddCriterium" type="button" class="btn btn-secondary mb-3"xa>Add Criterium</button>
            <button id="btnSubmit" type="submit" class="btn btn-primary mb-3">Create Evaluation</button>
        </form>
    </div>
</body>
</html>
