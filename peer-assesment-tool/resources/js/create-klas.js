import { postStudentKlas } from "./api.js";
import { getTableFromExcel, reader } from "./file-read.js";

const frmKlas = document.querySelector('#frmKlas');
const inKlasNaam = document.querySelector('#inKlasNaam');
const selVakId = document.querySelector('#selVakId');
const inFileImport = document.querySelector('#inFileImport');
let students = null;

async function handleFrmKlasSubmit(e) {
    e.preventDefault();
    if (!students) return;
    try {
        const reponse = await postStudentKlas(students, inKlasNaam.value, selVakId.value);
        console.log(reponse);
    }
    catch (e) {
        console.log(e);
    }
}

function handleFileInputLoad(e) {
    e.preventDefault();
    console.log(e.target);
    students = getTableFromExcel(e.target.result);
}

frmKlas.addEventListener('submit', handleFrmKlasSubmit);
reader.addEventListener('load', handleFileInputLoad);