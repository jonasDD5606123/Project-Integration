document.addEventListener('DOMContentLoaded', () => {
  // Tel bestaande groepen bij het laden
  let groupCount = document.querySelectorAll('.kanban-column').length;

  // Alleen als de elementen bestaan, voeg eventlisteners toe
  const randomBtn = document.querySelector('#randomBtn');
  const resetBtn = document.querySelector('#resetBtn');

  if (randomBtn && resetBtn) {
    randomBtn.addEventListener('click', distributeRandomly);
    resetBtn.addEventListener('click', resetStudents);
  }

  function distributeRandomly() {
    const sidebar = document.getElementById('studentList');
    const students = Array.from(sidebar.querySelectorAll('.student'));
    const groups = Array.from(document.querySelectorAll('.drop-zone'));

    if (groups.length === 0 || students.length === 0) return;

    // Shuffle students
    const shuffled = students.sort(() => Math.random() - 0.5);

    // Distribute in round-robin
    shuffled.forEach((student, index) => {
      const groupIndex = index % groups.length;
      groups[groupIndex].appendChild(student);
      student.style.opacity = '1';
    });
  }

  function resetStudents() {
    const sidebar = document.getElementById('studentList');
    if (!sidebar) return;

    const students = Array.from(document.querySelectorAll('.student'));
    students.forEach(student => {
      sidebar.appendChild(student);
      student.style.opacity = '1';
    });
  }

  // Drag & drop handlers
  window.allowDrop = function (ev) {
    ev.preventDefault();
    ev.currentTarget.classList.add('drag-over');
  };

  window.allowDropSidebar = function (ev) {
    ev.preventDefault();
    ev.currentTarget.classList.add('drag-over');
  };

  window.dragEnter = function (ev) {
    if (ev.target.classList.contains('drop-zone') || ev.target.id === 'studentList') {
      ev.target.classList.add('active');
    }
  };

  window.dragLeave = function (ev) {
    if (ev.target.classList.contains('drop-zone') || ev.target.id === 'studentList') {
      ev.target.classList.remove('active');
    }
  };

  window.drag = function (ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    ev.target.classList.add('dragging');
  };

  window.dragend = function (ev) {
    ev.target.classList.remove('dragging');
  };

  window.drop = function (ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text");
    const student = document.getElementById(data);
    const dropZone = ev.currentTarget;
    if (student && dropZone) {
      student.classList.remove('dragging');
      dropZone.appendChild(student);
    }
    dropZone.classList.remove('drag-over');
  };

  document.querySelectorAll('.drop-zone').forEach(zone => {
    zone.addEventListener('dragleave', function() {
      this.classList.remove('drag-over');
    });
    zone.addEventListener('drop', function() {
      this.classList.remove('drag-over');
    });
  });

  window.dropSidebar = function (ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text");
    const student = document.getElementById(data);
    const sidebar = document.getElementById('studentList');
    if (student && ev.currentTarget === sidebar) {
      // Bepaal uit welke groep deze student komt
      const oldGroup = student.closest('.drop-zone');
      if (oldGroup && oldGroup.getAttribute('data-group-id')) {
        let groupId = oldGroup.getAttribute('data-group-id');
        let studentId = student.id.replace('student', '');
        if (groupId && studentId) {
          deletedStudents.push({ groupId, studentId });
        }
      }
      student.classList.remove('dragging');
      sidebar.appendChild(student);
      student.style.opacity = '1';
    }
    ev.currentTarget.classList.remove('drag-over');
  };

  window.addGroup = function () {
    groupCount++;
    const row = document.getElementById('kanbanRow');
    if (!row) return;

    const addGroupBtn = row.lastElementChild;

    const column = document.createElement('div');
    column.className = 'col-12 col-sm-6 col-md-4 col-lg-3';
    column.innerHTML = `
      <div class="kanban-column card h-100">
        <div class="card-header kanban-column-header d-flex justify-content-between align-items-center">
          <span class="editable-title">Groep ${groupCount}</span>
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
             id="group_new_${groupCount}"
             data-group-id=""
             ondrop="drop(event)"
             ondragover="allowDrop(event)">
        </div>
      </div>
    `;
    row.insertBefore(column, addGroupBtn);
  };

  window.editGroupName = function (icon) {
    // Zoek de span.editable-title binnen de parent
    const parent = icon.closest('.kanban-column-header');
    const titleSpan = parent.querySelector('.editable-title');
    if (!titleSpan) return;

    const currentName = titleSpan.textContent;

    // Maak een input aan
    const input = document.createElement('input');
    input.type = 'text';
    input.value = currentName;
    input.className = 'form-control form-control-sm';
    input.style.maxWidth = '150px';

    // Vervang alleen de span door input
    titleSpan.replaceWith(input);

    input.focus();

    function save() {
      if (input.parentNode) {
        const newSpan = document.createElement('span');
        newSpan.className = 'editable-title';
        newSpan.textContent = input.value.trim() || currentName;
        input.replaceWith(newSpan);
      }
    }

    input.addEventListener('blur', save);
    input.addEventListener('keydown', e => {
      if (e.key === 'Enter') {
        e.preventDefault();
        save();
      }
    });
  };

  window.goToSummary = function () {
    const groups = Array.from(document.querySelectorAll('.drop-zone')).map((zone, i) => {
      const groupName = zone.parentNode.querySelector('.editable-title')?.textContent || `Groep ${i + 1}`;
      const students = Array.from(zone.querySelectorAll('.student')).map(s => s.textContent);
      return { name: groupName, students };
    });

    localStorage.setItem('kanbanGroups', JSON.stringify(groups));
    window.location.href = "/groepen"; // Laravel route
  };

  // Code voor summary pagina (check of container bestaat)
  const container = document.getElementById('groupsContainer');
  if (container) {
    const groups = JSON.parse(localStorage.getItem('kanbanGroups') || '[]');

    groups.forEach((group, index) => {
      const col = document.createElement('div');
      col.className = 'col-md-4 mb-4';

      col.innerHTML = `
          <div class="card p-3 shadow-sm group-card" style="cursor:pointer;" onclick="showGroup(${index})">
            <h5>${group.name}</h5>
            <p>${group.students.length} student(en)</p>
          </div>
        `;
      container.appendChild(col);
    });

    window.showGroup = function (index) {
      localStorage.setItem('selectedGroupIndex', index);
      window.location.href = "/groep";
    };
  }

  // Code voor individuele groep pagina
  const groupTitle = document.getElementById('groupTitle');
  const studentList = document.getElementById('studentList');

  if (groupTitle && studentList) {
    const groups = JSON.parse(localStorage.getItem('kanbanGroups') || '[]');
    const index = parseInt(localStorage.getItem('selectedGroupIndex'), 10);
    const group = groups[index] || { name: 'Onbekend', students: [] };

    groupTitle.textContent = group.name;

    group.students.forEach(student => {
      const li = document.createElement('li');
      li.className = 'list-group-item';
      li.textContent = student;
      studentList.appendChild(li);
    });
  }

  const saveBtn = document.getElementById('saveGroupsBtn');
  const saveSpinner = document.getElementById('saveSpinner');
  if (saveBtn) {
    saveBtn.addEventListener('click', async function () {
      // Toon spinner en disable knop
      saveBtn.disabled = true;
      saveSpinner.classList.remove('d-none');

      const feedback = document.getElementById('feedback');
      feedback.innerHTML = "";

      // Verzamel groepen en studenten
      const groepen = Array.from(document.querySelectorAll('.drop-zone')).map((zone, i) => {
        let groupId = zone.getAttribute('data-group-id');
        if (!groupId || isNaN(groupId)) groupId = null;
        const groupName = zone.parentNode.querySelector('.editable-title')?.textContent || `Groep ${i + 1}`;
        // Filter alleen studenten met een geldige id
        const students = Array.from(zone.querySelectorAll('.student'))
          .map(s => s.id.replace('student', ''))
          .filter(id => id && id !== "" && id !== "undefined" && id !== "null");
        return { groupName, groupId, students };
      });

      // Validatie
      const vakId = document.getElementById('selectVak')?.value;
      const evaluatieId = document.getElementById('selectEvaluatie')?.value;
      if (!vakId || !evaluatieId) {
        feedback.innerHTML = `<div class="alert alert-danger">Selecteer een vak en evaluatie.</div>`;
        return;
      }
      if (!groepen.length) {
        feedback.innerHTML = `<div class="alert alert-danger">Er moet minimaal één groep zijn.</div>`;
        return;
      }

      // POST naar backend
      try {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const response = await fetch('/api/studenten-groepen', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token,
          },
          body: JSON.stringify({
            groepen: groepen,
            vakId,
            evaluatieId,
            deleted: deletedGroups,
            deletedStudents: deletedStudents, // <-- nieuw
          }),
        });

        const result = await response.json();
        if (response.ok && result.success) {
          feedback.innerHTML = `<div class="alert alert-success">Groepen succesvol opgeslagen!</div>`;
        } else {
          feedback.innerHTML = `<div class="alert alert-danger">${result.error || 'Opslaan mislukt.'}</div>`;
        }
      } catch (e) {
        feedback.innerHTML = `<div class="alert alert-danger">Fout bij opslaan: ${e.message}</div>`;
      }

      // Na fetch (in beide gevallen: success of error)
      saveBtn.disabled = false;
      saveSpinner.classList.add('d-none');
    });
  }

  // Globale variabele om verwijderde groepen bij te houden
  let deletedGroups = [];
  let deletedStudents = []; // <-- nieuw

  // Pas je deleteGroup functie aan:
  window.deleteGroup = function (icon) {
    const col = icon.closest('.col-12, .col-sm-6, .col-md-4, .col-lg-3');
    if (!col) return;
    const dropZone = col.querySelector('.drop-zone');
    let groupId = dropZone.getAttribute('data-group-id');
    if (groupId && !isNaN(groupId)) {
      deletedGroups.push(Number(groupId));
    }
    // Verplaats studenten terug naar de sidebar
    const students = col.querySelectorAll('.student');
    const sidebar = document.getElementById('studentList');
    students.forEach(student => {
      sidebar.appendChild(student);
      student.style.opacity = '1';
    });
    // Verwijder de groep-kolom uit het DOM
    col.remove();
  };
});
