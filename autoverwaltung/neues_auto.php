<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Auto einfügen</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
    }

    h1 {
        color: #d32f2f; 
        border-bottom: 2px solid #d32f2f;
        padding-bottom: 10px;
    }

    /* Formular Styling */
    form {
        background: white;
        width: 40%;
        margin: auto;
        padding: 20px;
        border-radius: 8px;
        border-left: 5px solid #2e7d32; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    input[type="submit"] {
        background-color: #2e7d32; /* Grün */
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #1b5e20; /* Dunkleres Grün beim Drüberfahren */
    }

   

    /* Links */
    a {
        color: #2e7d32;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<h1>Neues Auto einfügen</h1>

<!-- Formular für neue Autos einfügen -->
<form>
    <!-- TODO: Eingabefeld für Marke -->
     <label for="marke">Marke:</label>
    <input type="text" id="marke" name="marke"><br><br>
    <!-- TODO: Eingabefeld für Modell -->
    <label for="modell">Modell:</label>
    <input type="text" id="modell" name="modell"><br><br>
    <!-- TODO: Eingabefeld für Baujahr -->
    <label for="baujahr">Baujahr:</label>
    <input type="number" id="baujahr" name="baujahr"><br><br>
    <!-- TODO: Eingabefeld für Preis -->
    <label for="preis">Preis:</label>
    <input type="number" id="preis" name="preis" step="0.01"><br><br>
    <!-- TODO: Submit-Button -->
    <input type="submit" value="Auto hinzufügen">
</form>

<!-- TODO: Link zur Startseite einfügen -->
<p><a href="index.php">Startseite</a></p>


</body>
</html>
