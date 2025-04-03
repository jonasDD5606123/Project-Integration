import Pako from 'pako';

export async function postStudentKlas(students, klasNaam, vakId) {
    const url = '/api/studenten-klas';

    let response = null;

    const jsonData = JSON.stringify({students: students, klasNaam: klasNaam, vakId: vakId});

    const compressedData = Pako.gzip(jsonData);

    try {
        response = await fetch(url, {
            method: 'POST', // HTTP method
            headers: {
                'Content-Type': 'application/json',
                'Content-Encoding': 'gzip',
            },
            credentials: 'same-origin',
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

export async function postEvaluatie(titel , beschrijving, deadline, vakId, criteria) {
    const url = '/api/evaluatie'
    const body = {
        titel: titel,
        beschrijving: beschrijving,
        deadline: deadline,
        vakId: vakId,
        criteria: criteria
    };
    try {
        response = await fetch(url, {
            method: 'POST', // HTTP method
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'same-origin',
            body: JSON.stringify(body)
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