import { getTableFromExcel, reader } from "./file-read.js";
import { postSutdentGroups } from "./api.js";

const frmGroepen = document.querySelector('#frmGroepen');
const selVakId = document.querySelector('#selVakId');
const selEvaluatieId = document.querySelector('#selEvaluatieId');
let groups = null;

function prepareGroepen(fileContents) {
    const groupsObj = {};
    for (let i = 0; i < fileContents.rows.length; i++) {
        const row = fileContents.rows[i];
        const groupName = row['group name'];
        if (!groupsObj[groupName]) {
            groupsObj[groupName] = {
                groupName: groupName,
                students: []
            };
        }
        groupsObj[groupName].students.push(row['user id']);
    }
    // Zet om naar array:
    return Object.values(groupsObj);
}

async function handleFrmGroepenSubmit(e) {
    e.preventDefault();
    if (!groups) return;
    try {
        const result = await postSutdentGroups(groups, selVakId.value, selEvaluatieId.value);
        alert("Groepen succesvol geïmporteerd!");
        console.log(result);
    }
    catch (e) {
        alert("Fout bij importeren: " + e.message);
        console.log(e);
    }
}

function handleFileInputLoad(e) {
    const fileContents = getTableFromExcel(e.target.result);
    groups = prepareGroepen(fileContents);
    console.log({ groups, vakId: selVakId.value, evaluatieId: selEvaluatieId.value });
}

frmGroepen.addEventListener('submit', handleFrmGroepenSubmit);
reader.addEventListener('load', handleFileInputLoad);