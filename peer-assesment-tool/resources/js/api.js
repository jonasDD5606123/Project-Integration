import axios from 'axios';
import Pako from 'pako';

// Function to post student klas with gzip compression
export async function postStudentKlas(students, klasNaam, vakId) {
    const url = '/studenten-klas';

    let response = null;

    const jsonData = JSON.stringify({ students, klasNaam, vakId });

    // Compress the data with Pako
    const compressedData = Pako.gzip(jsonData);

    // Get the CSRF token from the meta tag
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    try {
        response = await axios.post(url, compressedData, {
            headers: {
                'Content-Type': 'application/json',
                'Content-Encoding': 'gzip',
                'X-CSRF-TOKEN': csrfToken,  // Send CSRF token with the request
            },
            withCredentials: true, // Ensure cookies (session cookies) are sent
        });
    } catch (error) {
        throw new Error('Er kon geen verbinding gemaakt worden met de server.');
    }

    // Handle server errors (non-200 status codes)
    if (response.ok) {
        throw new Error('Server heeft met foutcode geantwoord.');
    }

    return response.data;
}

// Function to post evaluatie
export async function postEvaluatie(titel, beschrijving, deadline, vakId, criteria) {
    const url = '/api/evaluatie';
    const body = {
        titel,
        beschrijving,
        deadline,
        vakId,
        criteria,
    };

    let response = null;

    // Get the CSRF token from the meta tag
    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

    try {
        response = await axios.post(url, body, {
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,  // Send CSRF token with the request
            },
            withCredentials: true, // Ensure cookies (session cookies) are sent
        });
    } catch (error) {
        throw new Error('Er kon geen verbinding gemaakt worden met de server.');
    }

    // Handle server errors (non-200 status codes)
    if (response.status !== 200) {
        throw new Error('Server heeft met foutcode geantwoord.');
    }

    return response.data;
}
