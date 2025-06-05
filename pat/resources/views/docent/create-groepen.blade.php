<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Groepen beheer</title>
    @vite([
        'resources/js/app.js',
        'resources/css/app.css'
    ])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container-fluid mt-5">
        <a href="{{ route('docent.studentenbeheer') }}" class="btn btn-outline-secondary mb-3">
            Back
        </a>
        <!-- Filter Form -->
        <form method="GET" action="{{ url('/groepen/create') }}" class="mb-3">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="selectVak" class="col-form-label">Kies vak:</label>
                </div>
                <div class="col-auto">
                    <select id="selectVak" name="vak_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Selecteer vak --</option>
                        @foreach($vakken as $vak)
                            <option value="{{ $vak->id }}" {{ (isset($selectedVak) && $selectedVak == $vak->id) ? 'selected' : '' }}>
                                {{ $vak->naam }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label for="selectKlas" class="col-form-label">Kies klas:</label>
                </div>
                <div class="col-auto">
                    <select id="selectKlas" name="klas_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Selecteer klas --</option>
                        @foreach($klassen as $klas)
                            @if($klas->vak_id == $selectedVak)
                                <option value="{{ $klas->id }}" {{ (isset($selectedKlas) && $selectedKlas == $klas->id) ? 'selected' : '' }}>
                                    {{ $klas->naam }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label for="selectEvaluatie" class="col-form-label">Kies evaluatie:</label>
                </div>
                <div class="col-auto">
                    <select id="selectEvaluatie" name="evaluatie_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Selecteer evaluatie --</option>
                        @foreach($evaluaties as $evaluatie)
                            @if($evaluatie->vak_id == $selectedVak)
                                <option value="{{ $evaluatie->id }}" {{ (isset($selectedEvaluatie) && $selectedEvaluatie == $evaluatie->id) ? 'selected' : '' }}>
                                    {{ $evaluatie->titel }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
        <!-- End Filter Form -->

        <div class="row kanban">
            <!-- Sidebar -->
            <div class="col-md-3 sidebar p-3 d-flex flex-column">
                <h5 class="mb-4">Studenten</h5>
                <div id="studentControls" class="flex-grow-0">
                    <button id="randomBtn" class="btn btn-secondary mb-2">Verdeel</button>
                    <button id="resetBtn" class="btn btn-secondary mb-2" style="background: #6c757d;">↻ Reset</button>
                    <div class="mt-2 mb-3 text-muted small">
                        Totaal studenten: <span class="badge bg-primary">{{ count($studenten) }}</span>
                    </div>

                    @php
                        // Verzamel alle r_nummers van studenten die al in een groep zitten
                        $studentenInGroepen = collect();
                        if(isset($groepen)) {
                            foreach($groepen as $groep) {
                                if(isset($groep->studenten)) {
                                    $studentenInGroepen = $studentenInGroepen->merge($groep->studenten->pluck('r_nummer'));
                                }
                            }
                        }
                    @endphp

                    <div id="studentList" ondrop="dropSidebar(event)" ondragover="allowDropSidebar(event)">
                        @php $heeftStudenten = false; @endphp
                        @foreach ($studenten as $student)
                            @if(!$studentenInGroepen->contains($student->r_nummer))
                                @php $heeftStudenten = true; @endphp
                                <div id="student{{ $student->r_nummer }}" class="student mb-3" draggable="true" ondragstart="drag(event)">
                                    {{ $student->voornaam }} {{ $student->achternaam }}
                                </div>
                            @endif
                        @endforeach
                        @if(!$heeftStudenten)
                            <div class="text-muted text-center py-5" style="pointer-events: none;">
                                <em>Sleep studenten hierheen om ze uit een groep te halen</em>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- Geen formulier of button meer hier --}}
            </div>

            <!-- Kanban Board -->
            <div class="col-md-9 kanban-container">
                <!-- Voeg dit toe boven je kanban board -->
                <div id="feedback"></div>

                <div class="row g-4" id="kanbanRow">
                    @if(isset($groepen))
                        @foreach($groepen as $groep)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="kanban-column card h-100">
                                    <div class="card-header kanban-column-header d-flex justify-content-between align-items-center">
                                        <span class="editable-title">{{ $groep->naam }}</span>
                                        <div>
                                            <a href="javascript:void(0);" class="edit-icon text-primary me-2" onclick="editGroupName(this)">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="delete-icon text-danger" onclick="deleteGroup(this)">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body kanban-column-body drop-zone"
                                         id="group{{ $groep->id }}"
                                         data-group-id="{{ $groep->id }}"
                                         ondrop="drop(event)"
                                         ondragover="allowDrop(event)">
                                        @if(isset($groep->studenten) && $groep->studenten->count())
                                            @foreach($groep->studenten as $student)
                                                <div class="student mb-2"
                                                     id="student{{ $student->r_nummer }}"
                                                     draggable="true"
                                                     ondragstart="drag(event)"
                                                     ondragend="dragend(event)">
                                                    {{ $student->voornaam }} {{ $student->achternaam }}
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-muted small">Geen studenten</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-info text-center">Geen groepen gevonden.</div>
                        </div>
                    @endif
                    <!-- Add Group Button -->
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex align-items-center justify-content-center">
                        <button class="add-group-btn rounded btn btn-outline-primary" onclick="addGroup()">+ groep toevoegen</button>
                    </div>
                </div>

                <!-- Na </div> van je kanban board -->
                <div class="text-end mt-4">
                    <button id="saveGroupsBtn" class="btn btn-success">
                        <span id="saveSpinner" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                        Opslaan groepen
                    </button>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/kanban.js'])
</body>
</html>