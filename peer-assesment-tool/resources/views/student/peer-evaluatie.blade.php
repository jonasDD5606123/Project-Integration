<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Peer-Evaluatie</title>
    @vite(['node_modules/bootstrap/dist/css/bootstrap.min.css', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<body>
<div class="peer-assessment">
        <div class="container">
            <!-- Sidebar met studenten -->
            <aside class="sidebar">
                <h2>Studenten</h2>
                <ul class="student-list" id="studentList" role="list">
                    <li data-name="Jean Dupont" class="active" tabindex="0" role="listitem" aria-selected="true">Jean Dupont</li>
                    <li data-name="Marie Curie" tabindex="0" role="listitem" aria-selected="false">Marie Curie</li>
                    <li data-name="Albert Einstein" tabindex="0" role="listitem" aria-selected="false">Albert Einstein</li>
                    <li data-name="Isaac Newton" tabindex="0" role="listitem" aria-selected="false">Isaac Newton</li>
                </ul>
                <button id="saveAllBtn" aria-label="Sla alle evaluaties op">Save alle evaluaties</button>
            </aside>

            <!-- Content: formulier -->
            <main class="content" role="main">
                <div id="formContainer">
                    <h2>Evaluatie voor <span id="selectedStudentName">Jean Dupont</span></h2>
                    <form id="evaluationForm" aria-labelledby="selectedStudentName">
                        <fieldset>
                            <legend>1. Heeft deze student goed samengewerkt?</legend>
                            <label for="q1-ja">
                                <input type="radio" id="q1-ja" name="question1" value="Ja" required /> Ja
                            </label>
                            <label for="q1-nee">
                                <input type="radio" id="q1-nee" name="question1" value="Nee" /> Nee
                            </label>
                        </fieldset>

                        <fieldset>
                            <legend>2. Heeft deze student zijn/haar taken op tijd afgerond?</legend>
                            <label for="q2-ja">
                                <input type="radio" id="q2-ja" name="question2" value="Ja" required /> Ja
                            </label>
                            <label for="q2-nee">
                                <input type="radio" id="q2-nee" name="question2" value="Nee" /> Nee
                            </label>
                        </fieldset>

                        <fieldset>
                            <legend>3. Hoe zou je de communicatie van deze student beoordelen?</legend>
                            <label for="q3-goed">
                                <input type="radio" id="q3-goed" name="question3" value="Goed" required /> Goed
                            </label>
                            <label for="q3-matig">
                                <input type="radio" id="q3-matig" name="question3" value="Matig" /> Matig
                            </label>
                            <label for="q3-slecht">
                                <input type="radio" id="q3-slecht" name="question3" value="Slecht" /> Slecht
                            </label>
                        </fieldset>

                        <button type="submit" aria-label="Bewaar evaluatie">Bewaar deze evaluatie</button>
                    </form>
                </div>

                <div id="overviewContainer" style="display:none;">
                    <h2>Overzicht van alle evaluaties</h2>
                    <div id="allEvaluations"></div>
                    <button id="backBtn" aria-label="Terug naar evaluatie formulier">Terug naar formulier</button>
                </div>
            </main>
        </div>
    </div>
</body>

</html>