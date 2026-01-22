<?php
include 'verbindung/db.php';
$artid = $_GET['artid'];
$sql="SELECT * FROM artikel JOIN kategorie ON kategorieID = kID AND artID = ?";
$cmd=$verbindung->prepare($sql);
$cmd->execute([$artid]);
$artikel=$cmd->fetch();

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
    <title>Produkt bearbeiten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Produkt bearbeiten</h2>

    <form action="artaktionen/aktualisieren.php" method="post" enctype="multipart/form-data">

        <input type="hidden" name="artID" value="<?php echo $artikel['artID']; ?>">

        <div class="mb-3">
            <label class="form-label">Produktname</label>
            <input type="text" name="name" class="form-control" value="<?php echo $artikel['name']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Preis (€)</label>
            <input type="number" name="preis" class="form-control" value="<?php echo $artikel['preis']; ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Kategorie</label>
            <select name="kategorie" class="form-select">
                <?php
                
                foreach($kategorien as $k) {
                    $selectedtext = "";
                   // $selected = ($k['kID'] == $artikel['kategorieID']) ? "selected" : "";
                   if($k['kID'] == $artikel['kategorieID']){
                       $selectedtext = "selected";
                   }
                    echo "<option value='".$k['kID']."' ".$selectedtext.">".$k['kName']."</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Aktuelles Bild</label><br>
            <img src="uploads/<?php echo $artikel['bild']; ?>" width="120">
        </div>

        <div class="mb-3">
            <label>Neues Bild hochladen</label>
            <input type="file" name="bild" class="form-control">
        </div>

        <button class="btn btn-success">Aktualisieren</button>
        <a href="index.php" class="btn btn-secondary">Abbrechen</a>

    </form>
</div>

</body>
</html>
