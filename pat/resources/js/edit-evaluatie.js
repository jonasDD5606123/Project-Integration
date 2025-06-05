document.addEventListener('DOMContentLoaded', function () {
    const btnAddCriterium = document.getElementById('btnAddCriterium');
    const criteriaContainer = document.getElementById('criteriaContainer');

    let nextIndex = window.criteriaNextIndex || 0;

    btnAddCriterium.addEventListener('click', function () {
        const div = document.createElement('div');
        div.classList.add('mb-3', 'border', 'rounded', 'p-2', 'criterium-group');
        div.innerHTML = `
            <label class="form-label">Criterium</label>
            <input type="text" class="form-control" name="criteria[${nextIndex}][criterium]" required>
            <label class="form-label mt-2">Min Value</label>
            <input type="number" class="form-control" name="criteria[${nextIndex}][min_waarde]" required>
            <label class="form-label mt-2">Max Value</label>
            <input type="number" class="form-control" name="criteria[${nextIndex}][max_waarde]" required>
            <button type="button" class="btn btn-danger btnRemoveCriterium mt-2">Verwijder</button>
        `;
        criteriaContainer.appendChild(div);

        div.querySelector('.btnRemoveCriterium').addEventListener('click', function () {
            div.remove();
        });

        nextIndex++;
    });

    // Verwijder bestaande criteria client-side (optioneel)
    document.querySelectorAll('.btnRemoveCriterium').forEach(btn => {
        btn.addEventListener('click', function () {
            btn.closest('.criterium-group').remove();
        });
    });
});