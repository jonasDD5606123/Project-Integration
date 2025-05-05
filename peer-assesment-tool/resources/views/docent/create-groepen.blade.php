<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kanban Groepen</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
    <style>
        body {
            overflow-x: hidden;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            height: 100vh;
            position: sticky;
            top: 0;
            background-color: #f8f9fa;
            border-right: 1px solid #dee2e6;
        }

        .kanban-container {
            flex-grow: 1;
            padding: 20px;
            background-color: #f5f7fa;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .kanban-scroll {
            display: flex;
            gap: 20px;
            padding: 10px 5px;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            scroll-behavior: smooth;
        }

        .kanban-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .kanban-scroll::-webkit-scrollbar-thumb {
            background-color: #ced4da;
            border-radius: 4px;
        }

        .kanban-column {
            flex: 0 0 auto;
            width: 280px;
            min-height: 400px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-top: 4px solid #6c757d;
        }

        .kanban-column-header {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            color: #495057;
        }

        .kanban-column-body {
            padding: 15px;
            min-height: 300px;
        }

        .student {
            background: white;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            cursor: grab;
            border-left: 3px solid #4e73df;
            transition: all 0.2s;
        }

        .student:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .add-group-btn {
            width: 280px;
            height: 60px;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.2s;
        }

        .add-group-btn:hover {
            background: #e9ecef;
            color: #495057;
            border-color: #adb5bd;
        }

        .drop-zone {
            min-height: 100px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .drop-zone.active {
            background: rgba(78, 115, 223, 0.1);
            border: 2px dashed #4e73df;
        }

        #studentList {
            min-height: 200px;
            padding: 10px;
            border: 2px dashed #dee2e6;
            background-color: #f8f9fa;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        #studentList.drag-over {
            background-color: rgba(78, 115, 223, 0.1);
        }

        .random-btn {
            width: 100%;
            background: #4e73df;
            border: none;
            color: white;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .random-btn:hover {
            background: #2e59d9;
        }
    </style>
</head>

<body class="d-flex">

    <!-- Student Sidebar -->
    <div class="sidebar p-3">
        <h5 class="mb-4">Studenten</h5>
        <button id="randomBtn" class="random-btn">Random</button>
        <div id="studentList" ondrop="dropSidebar(event)" ondragover="allowDropSidebar(event)">
            <div id="student1" class="student mb-3" draggable="true" ondragstart="drag(event)">Jean Dupont</div>
            <div id="student2" class="student mb-3" draggable="true" ondragstart="drag(event)">Marie Curie</div>
            <div id="student3" class="student mb-3" draggable="true" ondragstart="drag(event)">Albert Einstein</div>
        </div>
    </div>

    <!-- Kanban Board -->
    <div class="kanban-container">
        <div class="kanban-scroll" id="kanbanRow">
            <!-- Groupe 1 -->
            <div class="kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(event)"
                ondragleave="dragLeave(event)">
                <div class="kanban-column-header">Groep 1</div>
                <div class="kanban-column-body drop-zone" id="group1">
                    <!-- Students will be dropped here -->
                </div>
            </div>

            <!-- Groupe 2 -->
            <div class="kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(event)"
                ondragleave="dragLeave(event)">
                <div class="kanban-column-header">Groep 2</div>
                <div class="kanban-column-body drop-zone" id="group2">
                    <!-- Students will be dropped here -->
                </div>
            </div>

            <!-- Groupe 3 -->
            <div class="kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)" ondragenter="dragEnter(event)"
                ondragleave="dragLeave(event)">
                <div class="kanban-column-header">Groep 3</div>
                <div class="kanban-column-body drop-zone" id="group3">
                    <!-- Students will be dropped here -->
                </div>
            </div>

            <!-- Add Group Button -->
            <div class="d-flex align-items-center justify-content-center">
                <button class="add-group-btn rounded" onclick="addGroup()">
                    + groep toevoegen
                </button>
            </div>
        </div>
    </div>

    <script>
        let groupCount = 3;

        document.querySelector('#randomBtn').addEventListener('click', distributeRandomly);

        // Fonction pour distribuer les étudiants de manière aléatoire
        function distributeRandomly() {
            const students = Array.from(document.querySelectorAll('.student'));
            const groups = Array.from(document.querySelectorAll('.drop-zone'));

            // Vider tous les groupes
            groups.forEach(group => group.innerHTML = '');

            // Mélanger les étudiants
            students.sort(() => Math.random() - 0.5);

            // Répartition aléatoire
            students.forEach(student => {
                const randomGroup = groups[Math.floor(Math.random() * groups.length)];
                randomGroup.appendChild(student);
                student.style.opacity = '1';
            });
        }

        // Permettre de faire glisser un étudiant dans un groupe
        function allowDrop(ev) {
            ev.preventDefault();
        }

        // Permettre de faire glisser un étudiant dans la sidebar
        function allowDropSidebar(ev) {
            ev.preventDefault();
            ev.target.classList.add('drag-over');
        }

        // Lorsqu'un étudiant entre dans une zone de dépôt (groupe ou sidebar)
        function dragEnter(ev) {
            if (ev.target.classList.contains('drop-zone') || ev.target.id === 'studentList') {
                ev.target.classList.add('active');
            }
        }

        // Lorsqu'un étudiant quitte une zone de dépôt
        function dragLeave(ev) {
            if (ev.target.classList.contains('drop-zone') || ev.target.id === 'studentList') {
                ev.target.classList.remove('active');
            }
        }

        // Lorsque l'on commence à faire glisser un étudiant
        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
            ev.target.style.opacity = '0.4';
        }

        // Lorsque l'étudiant est déposé dans une zone
        function drop(ev) {
            ev.preventDefault();
            const dropZones = document.querySelectorAll('.drop-zone');
            dropZones.forEach(zone => zone.classList.remove('active'));

            const data = ev.dataTransfer.getData("text");
            const student = document.getElementById(data);
            const dropZone = ev.target.closest('.drop-zone');

            if (student && dropZone) {
                student.style.opacity = '1';
                dropZone.appendChild(student);
            }

            // Gérer le dépose dans la sidebar
            if (ev.target.id === 'studentList') {
                student.style.opacity = '1';
                ev.target.appendChild(student);
            }
        }

        // Permet de déposer un étudiant dans la sidebar
        function dropSidebar(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            const student = document.getElementById(data);
            if (student && ev.target.id === 'studentList') {
                student.style.opacity = '1';
                ev.target.appendChild(student);
            }
        }

        // Ajouter un nouveau groupe
        function addGroup() {
            groupCount++;
            const row = document.getElementById('kanbanRow');
            const addGroupBtn = row.lastElementChild;

            const column = document.createElement('div');
            column.className = 'kanban-column';
            column.setAttribute('ondrop', 'drop(event)');
            column.setAttribute('ondragover', 'allowDrop(event)');
            column.setAttribute('ondragenter', 'dragEnter(event)');
            column.setAttribute('ondragleave', 'dragLeave(event)');

            column.innerHTML = `
                <div class="kanban-column-header">Groep ${groupCount}</div>
                <div class="kanban-column-body drop-zone" id="group${groupCount}"></div>
            `;

            row.insertBefore(column, addGroupBtn);
        }
    </script>
</body>

</html>
