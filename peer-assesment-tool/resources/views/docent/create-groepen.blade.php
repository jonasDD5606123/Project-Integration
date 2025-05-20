<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kanban Groepen</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body class="d-flex kanban">

    <!-- Student Sidebar -->
    <div class="sidebar p-3 d-flex flex-column">
    <h5 class="mb-4">Studenten</h5>
    <div id="studentControls" class="flex-grow-0">
        <button id="randomBtn" class="random-btn">🎲 Random</button>
        <button id="resetBtn" class="random-btn" style="background: #6c757d;">↻ Reset</button>
        <div id="studentList" ondrop="dropSidebar(event)" ondragover="allowDropSidebar(event)">
            <div id="student1" class="student mb-3" draggable="true" ondragstart="drag(event)">Jean Dupont</div>
            <div id="student2" class="student mb-3" draggable="true" ondragstart="drag(event)">Marie Curie</div>
            <div id="student3" class="student mb-3" draggable="true" ondragstart="drag(event)">Albert Einstein</div>
        </div>
    </div>

    <!-- Next knop helemaal onderaan met margin-top: auto -->
    <button class="btn btn-primary mt-auto" onclick="goToSummary()">Next ➔</button>
</div>

    <!-- Kanban Board -->
    <div class="kanban-container">
        <div class="kanban-scroll" id="kanbanRow">
            <!-- Groupe 1 -->
            <div class="kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(event)"
                ondragleave="dragLeave(event)">
                <div class="kanban-column-header">
                    <span class="editable-title">Groep 1</span>
                    <span class="edit-icon" onclick="editGroupName(this)">✏️</span>
                </div>
                <div class="kanban-column-body drop-zone" id="group1"></div>
            </div>

            <!-- Groupe 2 -->
            <div class="kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(event)"
                ondragleave="dragLeave(event)">
                <div class="kanban-column-header">
                    <span class="editable-title">Groep 2</span>
                    <span class="edit-icon" onclick="editGroupName(this)">✏️</span>
                </div>
                <div class="kanban-column-body drop-zone" id="group2"></div>
            </div>

            <!-- Groupe 3 -->
            <div class="kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(event)"
                ondragleave="dragLeave(event)">
                <div class="kanban-column-header">
                    <span class="editable-title">Groep 3</span>
                    <span class="edit-icon" onclick="editGroupName(this)">✏️</span>
                </div>
                <div class="kanban-column-body drop-zone" id="group3"></div>
            </div>

            <!-- Add Group Button -->
            <div class="d-flex align-items-center justify-content-center">
                <button class="add-group-btn rounded" onclick="addGroup()">+ groep toevoegen</button>
            </div>
        </div>
    </div>
</body>
</html>