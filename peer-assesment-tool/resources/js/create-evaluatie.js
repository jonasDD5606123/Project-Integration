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
    const index = container.children.length;
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

async function handleBtnSubmitClick(e) {
    e.preventDefault();
    
    console.log(inTitle.value);
    if (!inTitle.value) {
        console.log("Title is missing or empty.");
        return;
    }
    if (criteria.length == 0) {
        console.log("Criteria array is empty.");
        return;
    } 
    if (!selVakId.value) {
        console.log("Selected vak ID is missing.");
        return;
    }
    if (!inDeadline.value) {
        console.log("Deadline is missing.");
        return;
    }
    if (!inDesc.value) {
        console.log("Description is missing.");
        return;
    }
    if (!inDeadline.value) {  // Duplicate check
        console.log("Duplicate check: Deadline is missing.");
        return;
    }
    

    let criteriaValues = [];
    criteria.forEach(function (criterium) {
        const criteriumText = criterium.querySelector('.in__criterium');
        const min = criterium.querySelector('.in__min');
        const max = criterium.querySelector('.in__max');

        if (!criteriumText.value) {
            console.log("Criterium text is missing.");
            return;
        } 
        if (!min.value) {
            console.log("Minimum value is missing.");
            return;
        }
        if (!max.value) {
            console.log("Maximum value is missing.");
            return;
        }
        

        criteriaValues.push({
            criterium: criteriumText.value,
            min_waarde: min.value,
            max_waarde: max.value
        });
    });

    try {
        const response = postEvaluatie(
        inTitle.value,
        inDesc.value,
        inDeadline.value,
        selVakId.value,
        criteriaValues
    );

    console.log(response);
} catch (e) {
        console.log(e);
    }
}

btnAddCritierium.addEventListener('click', addCriterium);
btnSubmit.addEventListener('click', handleBtnSubmitClick);