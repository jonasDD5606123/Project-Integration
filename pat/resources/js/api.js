import Pako from 'pako';

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

export async function postStudentKlas(students, klasNaam, vakId, token = null) {
    const url = '/studenten-klas';
    token = token || getCsrfToken();
    console.log('CSRF Token (postStudentKlas):', token);
    const jsonData = JSON.stringify({students, klasNaam, vakId});
    const compressedData = Pako.gzip(jsonData);

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Content-Encoding': 'gzip',
                'X-CSRF-TOKEN': token,
            },
            body: compressedData
        });
        if (!response.ok) {
            throw new Error('Server heeft met foutcode geantwoord.');
        }
        return await response.json();
    } catch (e) {
        throw new Error(e.message || 'Er kon geen verbinding gemaakt worden met de server.');
    }
}

export async function postSutdentGroups(groepen, vakId, evaluatieId, token = null) {
    const url = '/studenten-groepen';
    token = token || getCsrfToken();
    console.log('CSRF Token (postSutdentGroups):', token);

    let response = null;
    const body = { groups: groepen, vakId, evaluatieId };
    const jsonData = JSON.stringify(body);
    const compressedData = Pako.gzip(jsonData);

    try {
        response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Content-Encoding': 'gzip',
                'X-CSRF-TOKEN': token,
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

export async function postEvaluatie(titel, beschrijving, deadline, vakId, criteria, token = null) {
    await fetch('/sanctum/csrf-cookie', { credentials: 'include' });

    token = token || getCsrfToken();
    console.log('CSRF Token (postEvaluatie):', token);

    const headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    };
    if (token) {
        headers['X-CSRF-TOKEN'] = token;
    }

    const response = await fetch('/api/evaluatie', {
        method: 'POST',
        headers: headers,
        credentials: 'include',
        body: JSON.stringify({
            titel,
            beschrijving,
            deadline,
            vakId,
            criteria
        })
    });
    return await response.json();
}