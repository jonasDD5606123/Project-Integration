import { postStudentKlas } from "./api.js";
import { getTableFromExcel, reader } from "./file-read.js";

const frmKlas = document.querySelector('#frmKlas');
const inKlasNaam = document.querySelector('#inKlasNaam');
const selVakId = document.querySelector('#selVakId');

console.log({"frmKlas": frmKlas, "inKlasNaam": inKlasNaam, "selVakId": selVakId});
let students = null;

function showFeedback(message, type = 'danger') {
    const feedback = document.getElementById('feedback');
    feedback.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
}

const submitBtn = document.getElementById('submitBtn');
const submitBtnSpinner = document.getElementById('submitBtnSpinner');
const submitBtnText = document.getElementById('submitBtnText');

async function handleFrmKlasSubmit(e) {
    e.preventDefault();

    // Validation
    if (!inKlasNaam.value.trim()) {
        showFeedback("Klas name is required.");
        return;
    }
    if (!selVakId.value) {
        showFeedback("Please select a vak.");
        return;
    }
    if (!students || students.length === 0) {
        showFeedback("Please import at least one student.");
        return;
    }

    // Show loading spinner
    submitBtn.disabled = true;
    submitBtnSpinner.style.display = 'inline-block';
    submitBtnText.textContent = 'Bezig...';

    try {
        const csrfToken = getCsrfToken();
        const response = await postStudentKlas(students, inKlasNaam.value, selVakId.value, csrfToken);
        showFeedback("Klas created successfully!", "success");
        console.log(response);
    }
    catch (e) {
        showFeedback(e.message || "An error occurred.");
        console.log(e);
    } finally {
        // Hide loading spinner and enable button
        submitBtn.disabled = false;
        submitBtnSpinner.style.display = 'none';
        submitBtnText.textContent = 'Create Klas';
    }
}

function handleFileInputLoad(e) {
    e.preventDefault();
    console.log(e.target);
    students = getTableFromExcel(e.target.result);
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

frmKlas.addEventListener('submit', handleFrmKlasSubmit);
reader.addEventListener('load', handleFileInputLoad)

