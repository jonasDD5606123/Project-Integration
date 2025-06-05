const studentList = document.getElementById("studentList");
const selectedStudentName = document.getElementById("selectedStudentName");
const form = document.getElementById("evaluationForm");
const saveAllBtn = document.getElementById("saveAllBtn");
const formContainer = document.getElementById("formContainer");
const overviewContainer = document.getElementById("overviewContainer");
const allEvaluationsDiv = document.getElementById("allEvaluations");
const backBtn = document.getElementById("backBtn");

// Object om antwoorden op te slaan per student
const evaluations = {};

// Active student - start met eerste
let activeStudent = studentList.querySelector("li.active").getAttribute("data-name");

function loadEvaluation(student) {
    selectedStudentName.textContent = student;

    // Markeer actieve student aria & active class
    [...studentList.children].forEach((li) => {
        li.classList.toggle("active", li.getAttribute("data-name") === student);
        li.setAttribute("aria-selected", li.getAttribute("data-name") === student ? "true" : "false");
    });

    // Vul formulier in als er data is opgeslagen
    if (evaluations[student]) {
        const answers = evaluations[student];
        form.question1.value = answers.question1 || "";
        form.question2.value = answers.question2 || "";
        form.question3.value = answers.question3 || "";
    } else {
        form.reset();
    }
}

// Initial load
loadEvaluation(activeStudent);

studentList.addEventListener("click", (e) => {
    if (e.target.tagName === "LI") {
        saveCurrentEvaluation();

        activeStudent = e.target.getAttribute("data-name");
        loadEvaluation(activeStudent);
    }
});

// Keyboard navigation for student list
studentList.addEventListener("keydown", (e) => {
    if (e.target.tagName === "LI") {
        if (e.key === "Enter" || e.key === " ") {
            e.preventDefault();
            saveCurrentEvaluation();
            activeStudent = e.target.getAttribute("data-name");
            loadEvaluation(activeStudent);
        }
    }
});

form.addEventListener("submit", (e) => {
    e.preventDefault();
    saveCurrentEvaluation();
    alert("Evaluatie opgeslagen voor " + activeStudent);
});

function saveCurrentEvaluation() {
    const formData = new FormData(form);
    evaluations[activeStudent] = {
        question1: formData.get("question1"),
        question2: formData.get("question2"),
        question3: formData.get("question3"),
    };
}

saveAllBtn.addEventListener("click", () => {
    saveCurrentEvaluation();

    formContainer.style.display = "none";
    overviewContainer.style.display = "block";

    allEvaluationsDiv.innerHTML = "";

    // Maak een tabel aan
    const table = document.createElement("table");

    const thead = document.createElement("thead");
    thead.innerHTML = `
        <tr>
            <th>Student</th>
            <th>1. Goed samengewerkt?</th>
            <th>2. Taken op tijd afgerond?</th>
            <th>3. Communicatie beoordeling</th>
        </tr>
    `;
    table.appendChild(thead);

    const tbody = document.createElement("tbody");

    for (const [student, answers] of Object.entries(evaluations)) {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${student}</td>
            <td>${answers.question1 || "-"}</td>
            <td>${answers.question2 || "-"}</td>
            <td>${answers.question3 || "-"}</td>
        `;
        tbody.appendChild(tr);
    }

    table.appendChild(tbody);
    allEvaluationsDiv.appendChild(table);
});

backBtn.addEventListener("click", () => {
    overviewContainer.style.display = "none";
    formContainer.style.display = "block";
});