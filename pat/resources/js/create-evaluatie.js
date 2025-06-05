import { postEvaluatie } from "./api.js";

const btnAddCritierium = document.querySelector('#btnAddCriterium');
const btnSubmit = document.querySelector('#btnSubmit');
const inTitle = document.querySelector('#inTitle');
const selVakId = document.querySelector('#selVakId');
const inDeadline = document.querySelector('#inDeadline');
const inDesc = document.querySelector('#inDesc');

let criteria = [];

function addCriterium() {
    const container = document.getElementById('criteriaContainer');
    const div = document.createElement('div');
    div.classList.add('criterium-group', 'mb-3');
    div.innerHTML = `
        <div class="mb-3">
            <label class="form-label">Criterium</label>
            <input type="text" class="form-control in__criterium" name="criterium[]" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Max Waarde</label>
            <input type="number" class="form-control in__min" name="max_waarde[]" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Min Waarde</label>
            <input type="number" class="form-control in__max" name="min_waarde[]" required>
        </div>
    ` ;
    const btn = document.createElement('button');
    btn.classList.add('btn', 'btn-danger');
    btn.attributes.type = 'button';
    btn.innerHTML = 'Remove Criterium'
    container.appendChild(div);
    div.appendChild(btn);
    criteria.push(div)
    btn.addEventListener('click', removeCriterium);
}

function removeCriterium(e) {
    e.preventDefault();
    const parent = e.target.parentElement;
    const removeIndex = criteria.lastIndexOf(parent);
    criteria.splice(removeIndex , 1);
    parent.remove();
}

function showFeedback(message, type = 'danger') {
    const feedback = document.getElementById('feedback');
    feedback.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
}

async function handleBtnSubmitClick(e) {
    e.preventDefault();

    if (!inTitle.value) {
        showFeedback("Title is missing or empty.");
        return;
    }
    if (criteria.length == 0) {
        showFeedback("At least one criterium is required.");
        return;
    } 
    if (!selVakId.value) {
        showFeedback("Please select a vak.");
        return;
    }
    if (!inDeadline.value) {
        showFeedback("Deadline is missing.");
        return;
    }
    if (!inDesc.value) {
        showFeedback("Description is missing.");
        return;
    }

    let criteriaValues = [];
    let hasError = false;
    criteria.forEach(function (criterium) {
        const criteriumText = criterium.querySelector('.in__criterium');
        const min = criterium.querySelector('.in__min');
        const max = criterium.querySelector('.in__max');

        if (!criteriumText.value) {
            showFeedback("Criterium text is missing.");
            hasError = true;
            return;
        } 
        if (!min.value) {
            showFeedback("Minimum value is missing.");
            hasError = true;
            return;
        }
        if (!max.value) {
            showFeedback("Maximum value is missing.");
            hasError = true;
            return;
        }

        criteriaValues.push({
            criterium: criteriumText.value,
            min_waarde: min.value,
            max_waarde: max.value
        });
    });

    if (hasError) return;

    let response;
    try {
        response = await postEvaluatie(
            inTitle.value,
            inDesc.value,
            inDeadline.value,
            selVakId.value,
            criteriaValues
        );
        showFeedback("Evaluation created successfully!", "success");
    } catch (e) {
        showFeedback(e.message || "An error occurred.");
        return;
    }

    console.log(response);
}

btnAddCritierium.addEventListener('click', addCriterium);
btnSubmit.addEventListener('click', handleBtnSubmitClick);