<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
    <div class="container mt-4">
        <div class="row kanban-container" id="kanbanRow">
            <!-- Studenten Column -->
            <div class="col-sm-6">
                <div class="card kanban-column">
                    <div class="card-body">
                        <h5 class="card-title">Studenten</h5>
                        <div id="student1" class="mb-2 p-2 border rounded shadow-sm student" draggable="true" ondragstart="drag(event)">Jean Dupont</div>
                        <div id="student2" class="mb-2 p-2 border rounded shadow-sm student" draggable="true" ondragstart="drag(event)">Marie Curie</div>
                        <div id="student3" class="mb-2 p-2 border rounded shadow-sm student" draggable="true" ondragstart="drag(event)">Albert Einstein</div>
                    </div>
                </div>
            </div>

            <!-- Groupe 1 -->
            <div class="col-sm-6 group-col">
                <div class="card kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <div class="card-body">
                        <h5 class="card-title">Groupe 1</h5>
                    </div>
                </div>
            </div>

            <!-- Groupe 2 -->
            <div class="col-sm-6 group-col">
                <div class="card kanban-column" ondrop="drop(event)" ondragover="allowDrop(event)">
                    <div class="card-body">
                        <h5 class="card-title">Groupe 2</h5>
                    </div>
                </div>
            </div>

            <!-- Add Group -->
            <div class="col-sm-6 add-column">
                <div class="card text-center h-100">
                    <div class="card-body d-flex align-items-center justify-content-center">
                        <button class="btn btn-outline-primary" onclick="addGroup()">+ Ajouter un groupe</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let groupCount = 2;

        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            const data = ev.dataTransfer.getData("text");
            const student = document.getElementById(data);
            const column = ev.target.closest('.card-body');
            if (student && column) {
                column.appendChild(student);
            }
        }

        function addGroup() {
            groupCount++;
            const row = document.getElementById('kanbanRow');
            const addCol = document.querySelector('.add-column');

            // Création du wrapper colonne
            const col = document.createElement('div');
            col.className = 'col-sm-6 group-col';

            // Création du groupe
            const card = document.createElement('div');
            card.className = 'card kanban-column';
            card.setAttribute('ondrop', 'drop(event)');
            card.setAttribute('ondragover', 'allowDrop(event)');
            card.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">Groupe ${groupCount}</h5>
            </div>
        `;

            col.appendChild(card);
            row.insertBefore(col, addCol);
        }
    </script>
</body>

</html>