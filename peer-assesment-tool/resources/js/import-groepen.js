import { getTableFromExcel } from './file-read.js';

document.addEventListener('DOMContentLoaded', () => {
    const frmGroepen = document.querySelector('#frmGroepen');
    const inFileImport = document.querySelector('#inFileImport');
    const resultTableBody = document.querySelector('#resultTable tbody');
    const vakSelect = document.querySelector('#selVakId');
    const csrfToken = document.querySelector('input[name="_token"]').value;

    let groepenData = null;

    inFileImport.addEventListener('change', function () {
        if (inFileImport.files.length === 0) return;

        const file = inFileImport.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const excelResult = getTableFromExcel(e.target.result);
            groepenData = {};

            resultTableBody.innerHTML = ''; // Leeg de tabel

            excelResult.rows.forEach(row => {
                const groepNaam = row['group name'];
                if (!groepNaam) return;

                if (!groepenData[groepNaam]) groepenData[groepNaam] = [];
                groepenData[groepNaam].push({
                    user_id: row['user id'],
                    first_name: row['first name'],
                    last_name: row['last name']
                });

                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${groepNaam}</td>
                    <td>${row['user id']}</td>
                    <td>${row['first name']}</td>
                    <td>${row['last name']}</td>
                `;
                resultTableBody.appendChild(tr);
            });
        };

        reader.readAsArrayBuffer(file);
    });

    frmGroepen.addEventListener('submit', async function (e) {
        e.preventDefault();
        if (!groepenData) {
            alert("Geen groepsgegevens geladen.");
            return;
        }

        const vakId = vakSelect.value;
        if (!vakId) {
            alert("Selecteer een vak.");
            return;
        }

        try {
            const response = await fetch('/groepen-importeren', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    vak_id: vakId,
                    groepen: groepenData
                })
            });

            if (!response.ok) {
                const text = await response.text();
                console.error("Server response:", text);
                alert("Fout bij import: " + text);
                return;
            }

            const result = await response.json();
            console.log("Server response:", result);
            alert('Groepen succesvol geïmporteerd!');
        } catch (err) {
            console.error("Fout bij import:", err);
            alert('Er is een fout opgetreden bij het importeren van groepen.');
        }
    });
});
