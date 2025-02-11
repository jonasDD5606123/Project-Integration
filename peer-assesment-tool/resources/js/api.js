export async function postStudentList(studentList) {
    const url = '/api/upload_list';

    let response = null;

    const jsonData = JSON.stringify({ data: studentList });
    const compressedData = pako.gzip(jsonData);

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