import * as XLSX from 'xlsx';
import Papa from 'papaparse';
import Pako from 'pako';

const frmFileImport = document.body.querySelector('#frmFileImport');
const inFileImport = frmFileImport.querySelector('#inFileImport');
const btnFileImportSubmit = frmFileImport.querySelector('#btnFileImportSubmit');

async function postStudentList(studentList) {
    const url = '/api/upload_list';

    let response = null;

    const jsonData = JSON.stringify({ data: studentList });

    const compressedData = Pako.gzip(jsonData);

    try {
        response = await fetch(url, {
            method: 'POST', // HTTP method
            headers: {
                'Content-Type': 'application/json',
                'Content-Encoding': 'gzip'
            },
            body: compressedData
        });
    } catch {
        throw new Error('Er kon geen verbinding gemaakt worden met de server.');
    }

    if (!response.ok) {
        throw new Error('Server heeft met foutcode geantwoord.');
    }

    let data;
    try {
        data = await response.json();
    } catch {
        throw new Error('Response van de server is in verkeerde formaat.');
    }

    return data;
}

function fromExcel(fileContent) {
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

    const data = { rows: rows };

    return data;
}

function fromCSV(fileContent) {
    const results = Papa.parse(fileContent, {
        header: true,
        dynamicTyping: true,
        skipEmptyLines: true,
    });

    const rows = results.data;
    const data = { rows: rows };

    return data;
}

async function handleExcelReaderLoad(e) {
    const fileContent = e.target.result;
    const result = fromExcel(fileContent);
    console.log(await postStudentList(result));
}

async function handleCSVReaderLoad(e) {
    const fileContent = e.target.result;
    const result = fromCSV(fileContent);
    console.log(await postStudentList(result));
}

function handleFileImportChange(e) {
    const file = e.target.files[0];

    if (!file) {
        return;
    }

    const reader = new FileReader();

    if (file.name.endsWith('.xlsx') || fileName.endsWith('.xls')) {
        reader.addEventListener('load', handleExcelReaderLoad);
    }
    else if (file.name.endsWith('.csv')) {
        reader.addEventListener('load', handleCSVReaderLoad);
    }

    reader.readAsArrayBuffer(file);
}

inFileImport.addEventListener('change', handleFileImportChange);