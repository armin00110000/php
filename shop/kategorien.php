<?php
include 'verbindung/db.php';
//Kategorie suchen
$sql="SELECT * FROM kategorie";
$cmd=$verbindung->prepare($sql);
$cmd->execute();
$kategorien=$cmd->fetchAll();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kategorien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Kategorien verwalten</h2>

    <form action="kataktionen/speichern.php" method="post" class="mb-4">
        <div class="row">
            <div class="col-md-8">
                <input type="text" name="kategorie" class="form-control" placeholder="Neue Kategorie">
            </div>
            <div class="col-md-4">
                <button name="kategorie_speichern"class="btn btn-primary w-100">Kategorie hinzufügen</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Kategorie</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($kategorien as $k){
        ?>
        <tr>
            <td><?php echo $k['kID']; ?></td>
            <td><?php echo $k['kName']; ?></td>
            <td>
                <a href="kategorie_bearbeiten.php?kid=<?php echo $k['kID']; ?>" class="btn btn-warning btn-sm">Bearbeiten</a>
                <a href="kataktionen/loeschen.php?kid=<?php echo $k['kID']; ?>" class="btn btn-danger btn-sm">Löschen</a>
            </td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary">Zurück zur Übersicht</a>
</div>

</body>
</html>
