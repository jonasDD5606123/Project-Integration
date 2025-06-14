<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <title>Groepen</title>
</head>

<body>
    <!-- Step 1: Select Group -->
    <div id="group-selection" class="step-container active">
        <h5>Stap 1: Kies je groep</h5>
        <p class="text-muted">Selecteer de groep waarvoor je een evaluatie wilt invullen.</p>

        <div class="row">
            @foreach ($groepen as $groep)
            <div class="col-md-6 mb-3">
                <div class="card border-primary">
                    <div class="card-body">
                        <h6 class="card-title">{{$groep->naam}}</h6>
                        <p class="card-text">
                            <small class="text-muted">
                                {{$groep->vak->naam}}<br>
                                Groepsleden: {{ count($groep->studenten)}}
                            </small>
                        </p>
                        <a href="{{ route('student.groep', ['groep' => $groep->id]) }}" class="btn btn-primary btn-sm">
                            Selecteer Groep
                        </a>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>

</html>