<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Evaluation - Layout Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .step-container {
            display: none;
        }
        .step-container.active {
            display: block;
        }
        .badge-lg {
            font-size: 1.1em;
            padding: 0.5rem 1rem;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4>Evaluatie - Student</h4>
                    </div>
                    <div class="card-body">
                        
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
                                            <button class="btn btn-primary btn-sm">
                                                Selecteer Groep
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Step 2: Select Partner -->
                        <div id="partner-selection" class="step-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Stap 2: Kies je groepsgenoot</h5>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Terug naar groepen
                                </button>
                            </div>
                            
                            <div class="alert alert-info">
                                <strong>Groep:</strong> Groep A - Web Development<br>
                                <strong>Vak:</strong> Web Development
                            </div>

                            <p class="text-muted">Selecteer de groepsgenoot die je wilt evalueren.</p>
                            
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="card border-success">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fas fa-user-circle fa-3x text-success"></i>
                                            </div>
                                            <h6 class="card-title">Marie Peters</h6>
                                            <p class="card-text">
                                                <small class="text-muted">marie@example.com</small>
                                            </p>
                                            <button class="btn btn-success btn-sm">
                                                Evalueer Marie
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="card border-success">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fas fa-user-circle fa-3x text-success"></i>
                                            </div>
                                            <h6 class="card-title">Tom De Vries</h6>
                                            <p class="card-text">
                                                <small class="text-muted">tom@example.com</small>
                                            </p>
                                            <button class="btn btn-success btn-sm">
                                                Evalueer Tom
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Fill Evaluation -->
                        <div id="evaluation-form" class="step-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Stap 3: Evaluatie invullen</h5>
                                <button class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-arrow-left"></i> Terug naar groepsgenoten
                                </button>
                            </div>

                            <div class="alert alert-info">
                                <strong>Groep:</strong> Groep A - Web Development<br>
                                <strong>Je evalueert:</strong> Marie Peters<br>
                                <strong>Evaluatie:</strong> Peer Evaluatie - Sprint 1
                            </div>

                            <form>
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Peer Evaluatie - Sprint 1</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="text-muted">Evalueer je groepsgenoot op basis van hun bijdrage aan de sprint.</p>
                                        <p><strong>Deadline:</strong> 
                                           <span class="badge bg-success">30/06/2025</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Evaluation Criteria -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Communicatie</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Score (1 - 10)</label>
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <input type="range" 
                                                           class="form-range" 
                                                           min="1" 
                                                           max="10" 
                                                           value="5">
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="badge bg-primary badge-lg" id="score_1">5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Feedback (optioneel)</label>
                                            <textarea class="form-control" 
                                                      rows="3" 
                                                      placeholder="Geef hier je feedback voor dit criterium..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Technische Vaardigheden</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Score (1 - 10)</label>
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <input type="range" 
                                                           class="form-range" 
                                                           min="1" 
                                                           max="10" 
                                                           value="5">
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="badge bg-primary badge-lg" id="score_2">5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Feedback (optioneel)</label>
                                            <textarea class="form-control" 
                                                      rows="3" 
                                                      placeholder="Geef hier je feedback voor dit criterium..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h6 class="mb-0">Teamwork</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Score (1 - 10)</label>
                                            <div class="row align-items-center">
                                                <div class="col-md-8">
                                                    <input type="range" 
                                                           class="form-range" 
                                                           min="1" 
                                                           max="10" 
                                                           value="5">
                                                </div>
                                                <div class="col-md-4">
                                                    <span class="badge bg-primary badge-lg" id="score_3">5</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Feedback (optioneel)</label>
                                            <textarea class="form-control" 
                                                      rows="3" 
                                                      placeholder="Geef hier je feedback voor dit criterium..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- General Feedback -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h6 class="mb-0">Algemene Feedback</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <textarea class="form-control" 
                                                      rows="4" 
                                                      placeholder="Geef hier je algemene feedback..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="text-center">
                                    <button type="button" class="btn btn-success btn-lg">
                                        <i class="fas fa-check"></i> Evaluatie Indienen
                                    </button>
                                    <button type="button" class="btn btn-secondary btn-lg ms-2">
                                        Annuleren
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    @vite("resources/js/fill-evaluatie.js")
</body>
/</html>