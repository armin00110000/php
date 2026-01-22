<?php
//Verbindung zur Datenbank herstellen
include 'verbindung/db.php';
//sql-Abfrage
$sql="SELECT * FROM artikel JOIN kategorie ON kategorieID = kID";
$cmd=$verbindung->prepare($sql);
$cmd->execute();
$artikeln=$cmd->fetchAll();

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Produktverwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Produktübersicht</h2>

    <div class="mb-3">
        <a href="produkt_hinzufuegen.php" class="btn btn-primary">➕ Produkt hinzufügen</a>
        <a href="kategorien.php" class="btn btn-secondary">📂 Kategorien verwalten</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Preis (€)</th>
            <th>Kategorie</th>
            <th>Lager</th>
            <th>Bild</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <!-- Beispieldaten -->
         <?php
            foreach($artikeln as $art){
                ?>
            
        <tr>
            <td><?php echo $art['artID']; ?></td>
            <td><?php echo $art['name']; ?></td>
            <td><?php echo $art['preis']; ?></td>
            <td><?php echo $art['kName']; ?></td>
            <td>Ja</td>
            <td><img src="uploads/<?php echo $art['bild']; ?>" width="70"></td>
            <td>
                <a href="produkt_bearbeiten.php?artid=<?php echo $art['artID']; ?>" class="btn btn-warning btn-sm">Bearbeiten</a>
                <a href="artaktionen/loeschen.php?artid=<?php echo $art['artID']; ?>" class="btn btn-danger btn-sm">Löschen</a>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
