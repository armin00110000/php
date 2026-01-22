<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Liste aller Autos</title>
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

    /* Tabellen Styling */
    table {
        width: 50%;
        margin: auto;
        border-collapse: collapse;
        background: white;
    }

    th {
        background-color: #d32f2f; /* Rot für den Tabellenkopf */
        color: white;
        padding: 12px;
    }

    td {
        padding: 10px;
        border: 1px solid #ddd;
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
<h1>Liste aller Autos</h1>

<!-- TODO: Tabelle für Autos erstellen -->
<table border="1">
    <tr>
        <th>Marke</th>
        <th>Modell</th>
        <th>Baujahr</th>
        <th>Preis (€)</th>
    </tr>
    <tr>
        <td>BMW</td>
        <td>3er</td>
        <td>2018</td>
        <td>25.000</td>
    </tr>
    <!-- TODO: 3 mehrere Beispielautos einfügen -->
    <tr>
        <td>Audi</td>
        <td>A4</td>
        <td>2019</td>
        <td>27.500</td>
    </tr>
    <tr>
        <td>Mercedes</td>
        <td>C-Klasse</td>
        <td>2020</td>
        <td>30.000</td>
    </tr>
    <tr>
        <td>Volkswagen</td>
        <td>Golf</td>
        <td>2017</td>
        <td>20.000</td>

</table>

<p>
    <!-- TODO: Link zur Startseite einfügen -->
    <a href="index.php">Startseite</a>

</p>

</body>
</html>
