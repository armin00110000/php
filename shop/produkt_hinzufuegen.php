<?php
//Verbindung zur Datenbank herstellen
include 'verbindung/db.php';
//Kategorien aus der Datenbank abrufen
$sql="SELECT * FROM kategorie";
$cmd=$verbindung->prepare($sql);
$cmd->execute();
$kategorie=$cmd->fetchAll();
//print_r($kategorie);
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produkt hinzufügen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Neues Produkt hinzufügen</h2>

    <form action="artaktionen/speichern.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label class="form-label">Produktname</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Preis (€)</label>
            <input type="number" name="preis" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategorie</label>
            <select name="kategorie" class="form-select">
                <?php
                foreach($kategorie as $k) {
                    echo "<option value='".$k['kID']."'>".$k['kName']."</option>";
                }
                ?>
            </select>
        </div>

        

        <div class="mb-3">
            <label class="form-label">Produktbild</label>
            <input type="file" name="bild" class="form-control">
        </div>

        <button type="submit" name="speichern" class="btn btn-success">Speichern</button>
        <a href="index.php" class="btn btn-secondary">Zurück</a>

    </form>
</div>

</body>
</html>
