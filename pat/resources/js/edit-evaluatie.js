document.addEventListener('DOMContentLoaded', function () {
    const btnAddCriterium = document.getElementById('btnAddCriterium');
    const criteriaContainer = document.getElementById('criteriaContainer');

    let nextIndex = window.criteriaNextIndex || 0;

    btnAddCriterium.addEventListener('click', function () {
        const div = document.createElement('div');
        div.classList.add('criterium-group');
        div.innerHTML = `
            <label>Criterium</label>
            <input type="text" name="criteria[${nextIndex}][criterium]" required>

            <label>Min Waarde</label>
            <input type="number" name="criteria[${nextIndex}][min_waarde]" required>

            <label>Max Waarde</label>
            <input type="number" name="criteria[${nextIndex}][max_waarde]" required>

            <button type="button" class="btn btn-remove btnRemoveCriterium">Verwijder</button>
        `;
        criteriaContainer.appendChild(div);

        div.querySelector('.btnRemoveCriterium').addEventListener('click', function () {
            div.remove();
        });

        nextIndex++;
    });

    // Bestaande criteria verwijder knopjes
    document.querySelectorAll('.btnRemoveCriterium').forEach(btn => {
        btn.addEventListener('click', function () {
            btn.closest('.criterium-group').remove();
        });
    });
});
