document.addEventListener('DOMContentLoaded', () => {
    let groupCount = 3;
  
    // Alleen als de elementen bestaan, voeg eventlisteners toe
    const randomBtn = document.querySelector('#randomBtn');
    const resetBtn = document.querySelector('#resetBtn');
  
    if (randomBtn && resetBtn) {
      randomBtn.addEventListener('click', distributeRandomly);
      resetBtn.addEventListener('click', resetStudents);
    }
  
    function distributeRandomly() {
      const students = Array.from(document.querySelectorAll('.student'));
      const groups = Array.from(document.querySelectorAll('.drop-zone'));
  
      groups.forEach(group => group.innerHTML = '');
  
      students.sort(() => Math.random() - 0.5);
  
      students.forEach(student => {
        const randomGroup = groups[Math.floor(Math.random() * groups.length)];
        randomGroup.appendChild(student);
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
    window.allowDrop = function(ev) {
      ev.preventDefault();
    };
  
    window.allowDropSidebar = function(ev) {
      ev.preventDefault();
      ev.target.classList.add('drag-over');
    };
  
    window.dragEnter = function(ev) {
      if (ev.target.classList.contains('drop-zone') || ev.target.id === 'studentList') {
        ev.target.classList.add('active');
      }
    };
  
    window.dragLeave = function(ev) {
      if (ev.target.classList.contains('drop-zone') || ev.target.id === 'studentList') {
        ev.target.classList.remove('active');
      }
    };
  
    window.drag = function(ev) {
      ev.dataTransfer.setData("text", ev.target.id);
      ev.target.style.opacity = '0.4';
    };
  
    window.drop = function(ev) {
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
  
      if (ev.target.id === 'studentList') {
        student.style.opacity = '1';
        ev.target.appendChild(student);
      }
    };
  
    window.dropSidebar = function(ev) {
      ev.preventDefault();
      const data = ev.dataTransfer.getData("text");
      const student = document.getElementById(data);
      if (student && ev.target.id === 'studentList') {
        student.style.opacity = '1';
        ev.target.appendChild(student);
      }
    };
  
    window.addGroup = function() {
      groupCount++;
      const row = document.getElementById('kanbanRow');
      if (!row) return;
  
      const addGroupBtn = row.lastElementChild;
  
      const column = document.createElement('div');
      column.className = 'kanban-column';
      column.setAttribute('ondrop', 'drop(event)');
      column.setAttribute('ondragover', 'allowDrop(event)');
      column.setAttribute('ondragenter', 'dragEnter(event)');
      column.setAttribute('ondragleave', 'dragLeave(event)');
  
      column.innerHTML = `
        <div class="kanban-column-header">
          <span class="editable-title">Groep ${groupCount}</span>
          <span class="edit-icon" onclick="editGroupName(this)">✏️</span>
        </div>
        <div class="kanban-column-body drop-zone" id="group${groupCount}"></div>
      `;
  
      row.insertBefore(column, addGroupBtn);
    };
  
    window.editGroupName = function(icon) {
      const titleSpan = icon.previousElementSibling;
      const currentName = titleSpan.textContent;
  
      const input = document.createElement('input');
      input.type = 'text';
      input.value = currentName;
      input.className = 'form-control form-control-sm';
      input.style.maxWidth = '150px';
  
      const parent = titleSpan.parentNode;
      parent.replaceChild(input, titleSpan);
  
      input.focus();
  
      function save() {
        if (parent.contains(input)) {
          const newSpan = document.createElement('span');
          newSpan.className = 'editable-title';
          newSpan.textContent = input.value.trim() || currentName;
          parent.replaceChild(newSpan, input);
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
  
    window.goToSummary = function() {
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
  
      window.showGroup = function(index) {
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
  });
  