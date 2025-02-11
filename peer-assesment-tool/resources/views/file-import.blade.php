<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/js/imports.js'])
</head>

<body>
    <form id="frmFileImport">
        <p>
            <input type="file" id="inFileImport" name="inFileImport">
        </p>
        <p>
            <button type="submit" id="btnFileImportSubmit" name="btnFileImportSubmit">submit</button>
        </p>
    </form>
</body>
</html>