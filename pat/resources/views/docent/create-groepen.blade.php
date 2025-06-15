<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Groepenbeheer</title>
    @vite(['resources/js/app.js', 'resources/css/dashboard-docent.css', 'resources/css/groepen.css'])
</head>

<body class="groepen-body">
    <header class="header">
        <div class="container">
            <h1>Welkom <span>{{ auth()->user()->voornaam }}</span></h1>
        </div>
        <div class="logout-form">
            @csrf
            <a href="{{ route('docent.studentenbeheer') }}" class="btn-back">← Terug</a>
        </div>
    </header>

    <main class="container">
        <div style="display: flex; gap: 30px; width: 100%;">
            <!-- Sidebar met studenten -->
            <div class="sidebar">
                <h2>Studenten</h2>
                <div class="btn-group">
                    <button id="randomBtn" class="btn small">Verdeel</button>
                    <button id="resetBtn" class="btn small gray">↻ Reset</button>
                </div>


                <div id="studentList" class="student-list" ondrop="dropSidebar(event)" ondragover="allowDropSidebar(event)">
                    @php
                    $studentenInGroepen = collect();
                    if (isset($groepen)) {
                    foreach ($groepen as $groep) {
                    if (isset($groep->studenten)) {
                    $studentenInGroepen = $studentenInGroepen->merge($groep->studenten->pluck('r_nummer'));
                    }
                    }
                    }
                    $heeftStudenten = false;
                    @endphp
                    @foreach ($studenten as $student)
                    @if(!$studentenInGroepen->contains($student->r_nummer))
                    @php $heeftStudenten = true; @endphp
                    <div id="student{{ $student->r_nummer }}" class="student" draggable="true" ondragstart="drag(event)">
                        {{ $student->voornaam }} {{ $student->achternaam }}
                    </div>
                    @endif
                    @endforeach
                    @if(!$heeftStudenten)
                    <div class="empty-message">Sleep studenten hierheen om ze uit een groep te halen</div>
                    @endif
                </div>
            </div>

            <!-- Rechts filters, groep toevoegen en kanban -->
            <section class="kanban-wrapper">
                <div class="filters-and-addgroup">
                    <!-- Filter Formulier -->
                    <form method="GET" action="{{ url('/groepen/create') }}" class="filter-form">
                        <div class="form-row">
                            <label for="selectVak">Vak
                                <select id="selectVak" name="vak_id" onchange="this.form.submit()">
                                    <option value="">-- Selecteer vak --</option>
                                    @foreach($vakken as $vak)
                                    <option value="{{ $vak->id }}" {{ (isset($selectedVak) && $selectedVak == $vak->id) ? 'selected' : '' }}>
                                        {{ $vak->naam }}
                                    </option>
                                    @endforeach
                                </select>
                            </label>

                            <label for="selectKlas">Klas
                                <select id="selectKlas" name="klas_id" onchange="this.form.submit()">
                                    <option value="">-- Selecteer klas --</option>
                                    @foreach($klassen as $klas)
                                    @if($klas->vak_id == $selectedVak)
                                    <option value="{{ $klas->id }}" {{ (isset($selectedKlas) && $selectedKlas == $klas->id) ? 'selected' : '' }}>
                                        {{ $klas->naam }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </label>

                            <label for="selectEvaluatie">Evaluatie
                                <select id="selectEvaluatie" name="evaluatie_id" onchange="this.form.submit()">
                                    <option value="">-- Selecteer evaluatie --</option>
                                    @foreach($evaluaties as $evaluatie)
                                    @if($evaluatie->vak_id == $selectedVak)
                                    <option value="{{ $evaluatie->id }}" {{ (isset($selectedEvaluatie) && $selectedEvaluatie == $evaluatie->id) ? 'selected' : '' }}>
                                        {{ $evaluatie->titel }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </label>
                        </div>
                    </form>

                    <!-- Knop groepen toevoegen -->
                    <div class="add-group-container">
                        <button class="btn add-btn" onclick="addGroup()">+ groep toevoegen</button>
                            <button id="saveGroupsBtn" class="btn primary">
                                <span id="saveSpinner" class="spinner d-none"></span>
                                Opslaan groepen
                            </button>
                    </div>
                    
                </div>


                <!-- Kanban board -->
                <div class="kanban-board">
                    <div id="feedback"></div>
                    <div class="kanban-columns" id="kanbanRow">
                        @if(isset($groepen))
                        @foreach($groepen as $groep)
                        <div class="kanban-column">
                            <div class="column-header">
                                <span class="editable-title">{{ $groep->naam }}</span>
                                <div class="column-actions">
                                    <span onclick="editGroupName(this)">✏️</span>
                                    <span onclick="deleteGroup(this)">🗑️</span>
                                </div>
                            </div>
                            <div class="column-body drop-zone" id="group{{ $groep->id }}" data-group-id="{{ $groep->id }}" ondrop="drop(event)" ondragover="allowDrop(event)">
                                @if(isset($groep->studenten) && $groep->studenten->count())
                                @foreach($groep->studenten as $student)
                                <div class="student" id="student{{ $student->r_nummer }}" draggable="true" ondragstart="drag(event)" ondragend="dragend(event)">
                                    {{ $student->voornaam }} {{ $student->achternaam }}
                                </div>
                                @endforeach
                                @else
                                <div class="empty-message">Geen studenten</div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @else
                        <div class="empty-message">Geen groepen gevonden.</div>
                        @endif
                    </div>


                </div>
            </section>
        </div>
    </main>

    @vite(['resources/js/kanban.js'])
</body>

</html>