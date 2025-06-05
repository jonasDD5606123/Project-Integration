import * as XLSX from 'xlsx';
import Papa from 'papaparse';

const inFileImports = document.body.querySelectorAll('.file__import');
export const reader = new FileReader();

export function getTableFromExcel(fileContent) {
    const excelWorkbook = XLSX.read(fileContent, { type: 'array' });
    const firstSheetName = excelWorkbook.SheetNames[0];
    const firstSheet = excelWorkbook.Sheets[firstSheetName];
    const sheetRange = XLSX.utils.decode_range(firstSheet['!ref']);

    let rows = [];
    let colNames = [];

    for (let col = sheetRange.s.c; col <= sheetRange.e.c; col++) {
        const cellAddress = { r: sheetRange.s.r, c: col };
        const cell = firstSheet[XLSX.utils.encode_cell(cellAddress)];
        colNames.push(cell ? cell.v : undefined);
    }

    for (let row = sheetRange.s.r + 1; row <= sheetRange.e.r; row++) {
        let rowData = {};

        for (let col = sheetRange.s.c; col <= sheetRange.e.c; col++) {
            const cellAddress = { r: row, c: col };
            const cell = firstSheet[XLSX.utils.encode_cell(cellAddress)];
            rowData[colNames[col - sheetRange.s.c]] = cell ? cell.v : undefined;
        }

        if (Object.values(rowData).some(value => value !== undefined && value !== null && value !== '')) {
            rows.push(rowData);
        }
    }

    const data = { rows: rows, colNames: colNames };

    return data;
}

function getTableFromCSV(fileContent) {
    const results = Papa.parse(fileContent, {
        header: true,
        dynamicTyping: true,
        skipEmptyLines: true,
    });

    const rows = results.data;
    const data = { rows: rows };

    return data;
}

function handleExcelReaderLoad(e) {
    const fileContent = e.target.result;
    const result = getTableFromExcel(fileContent);
    populateTable(result);
}

function handleCSVReaderLoad(e) {
    const fileContent = e.target.result;
    const result = getTableFromCSV(fileContent);
    populateTable(result);
}

function populateTable(data) {
    const tableBody = document.querySelector('#resultTable tbody');
    const tableHead = document.querySelector('#resultTable thead');

    // Clear any existing rows in the body and head
    tableBody.innerHTML = '';
    tableHead.innerHTML = '';

    // Create the header row based on colNames
    const headerRow = document.createElement('tr');
    data.colNames.forEach(colName => {
        const th = document.createElement('th');
        th.textContent = colName;
        headerRow.appendChild(th);
    });
    tableHead.appendChild(headerRow);

    // Loop through each student and create a row for the body
    data.rows.forEach(student => {
        const row = document.createElement('tr');

        // Loop through each column and create a cell for the student data
        data.colNames.forEach(colName => {
            const cell = document.createElement('td');
            cell.textContent = student[colName]; // Access the student data by column name
            row.appendChild(cell);
        });

        tableBody.appendChild(row);
    });
}

function handleFileImportChange(e) {
    const file = e.target.files[0];

    if (!file) {
        return;
    }

    if (file.name.endsWith('.xlsx') || fileName.endsWith('.xls')) {
        reader.addEventListener('load', handleExcelReaderLoad);
    }
    else if (file.name.endsWith('.csv')) {
        reader.addEventListener('load', handleCSVReaderLoad);
    }

    reader.readAsArrayBuffer(file);
}


inFileImports.forEach(function (inFileImport) {
    inFileImport.addEventListener('change', handleFileImportChange);
});
