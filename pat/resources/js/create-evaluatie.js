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
    div.classList.add('criterium-group');
    div.style.border = '1px solid #ddd';
    div.style.borderRadius = '10px';
    div.style.padding = '15px';
    div.style.background = '#f9fafb';

    div.innerHTML = `
        <div>
            <label>Criterium</label>
            <input type="text" class="in__criterium" name="criterium[]" required>
        </div>
        <div>
            <label>Max Waarde</label>
            <input type="number" class="in__max" name="max_waarde[]" required>
        </div>
        <div>
            <label>Min Waarde</label>
            <input type="number" class="in__min" name="min_waarde[]" required>
        </div>
    `;

    const btn = document.createElement('button');
    btn.type = 'button';
    btn.classList.add('btn-outline');
    btn.style.marginTop = '10px';
    btn.textContent = '❌ Verwijder Criterium';

    btn.addEventListener('click', removeCriterium);
    div.appendChild(btn);

    container.appendChild(div);
    criteria.push(div);
}

function removeCriterium(e) {
    const parent = e.target.parentElement;
    const index = criteria.indexOf(parent);
    if (index > -1) {
        criteria.splice(index, 1);
    }
    parent.remove();
}

function showFeedback(message, type = 'danger') {
    const feedback = document.getElementById('feedback');
    const colors = {
        danger: '#ffe4e4',
        success: '#e4f9e4'
    };
    const borderColors = {
        danger: '#dc2626',
        success: '#16a34a'
    };

    feedback.innerHTML = `
        <div style="
            background: ${colors[type]};
            border-left: 5px solid ${borderColors[type]};
            padding: 10px 15px;
            border-radius: 8px;
            color: ${type === 'danger' ? '#b91c1c' : '#15803d'};
            margin-top: 10px;
        ">
            ${message}
        </div>
    `;
}

async function handleBtnSubmitClick(e) {
    e.preventDefault();

    if (!inTitle.value.trim()) {
        showFeedback("Titel is verplicht.");
        return;
    }
    if (criteria.length === 0) {
        showFeedback("Minimaal één criterium is vereist.");
        return;
    }
    if (!selVakId.value) {
        showFeedback("Selecteer een vak.");
        return;
    }
    if (!inDeadline.value) {
        showFeedback("Deadline is verplicht.");
        return;
    }
    if (!inDesc.value.trim()) {
        showFeedback("Beschrijving is verplicht.");
        return;
    }

    let criteriaValues = [];
    let hasError = false;
    criteria.forEach(criterium => {
        const criteriumText = criterium.querySelector('.in__criterium');
        const min = criterium.querySelector('.in__min');
        const max = criterium.querySelector('.in__max');

        if (!criteriumText.value.trim()) {
            showFeedback("Criterium tekst ontbreekt.");
            hasError = true;
            return;
        }
        if (!min.value) {
            showFeedback("Minimum waarde ontbreekt.");
            hasError = true;
            return;
        }
        if (!max.value) {
            showFeedback("Maximum waarde ontbreekt.");
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

    try {
        const response = await postEvaluatie(
            inTitle.value,
            inDesc.value,
            inDeadline.value,
            selVakId.value,
            criteriaValues
        );
        showFeedback("Evaluatie succesvol aangemaakt!", "success");
        console.log(response);
    } catch (err) {
        showFeedback(err.message || "Er is een fout opgetreden.");
    }
}

btnAddCritierium.addEventListener('click', addCriterium);
btnSubmit.addEventListener('click', handleBtnSubmitClick);
