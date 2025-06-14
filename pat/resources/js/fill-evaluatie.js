let selectedGroep = null;
let groepMembers = [];

function showGroupSelection() {
    hideAllSteps();
    document.getElementById('group-selection').classList.add('active');
}

function showPartnerSelection() {
    hideAllSteps();
    document.getElementById('partner-selection').classList.add('active');
}

function showEvaluationForm() {
    hideAllSteps();
    document.getElementById('evaluation-form').classList.add('active');
}

function hideAllSteps() {
    document.querySelectorAll('.step-container').forEach(step => {
        step.classList.remove('active');
    });
}

function updateScore(criteriumId, value) {
    document.getElementById('score_' + criteriumId).textContent = value;
}

function submitEvaluation() {
    alert('Evaluatie succesvol ingediend! (Dit is een demo)');
    showGroupSelection();
}