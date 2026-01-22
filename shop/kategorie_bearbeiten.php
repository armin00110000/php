<?php
include 'verbindung/db.php';
$kategorie_id = $_GET['kid'];
$sql="SELECT * FROM kategorie WHERE kID = ?";
$cmd=$verbindung->prepare($sql);
$cmd->execute([$kategorie_id]);
$kategorie=$cmd->fetch();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Kategorie bearbeiten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Kategorie bearbeiten</h2>

    <form action="kataktionen/aktualisieren.php" method="post">
        <input type="hidden" name="kategorie_id" value="<?php echo htmlspecialchars($kategorie['kID']); ?>">
        <div class="mb-3">
            <label class="form-label">Kategoriename</label>
            <input type="text" name="kategorie_name" class="form-control" value="<?php echo htmlspecialchars($kategorie['kName']); ?>">
        </div>

        <button class="btn btn-success">Aktualisieren</button>
        <a href="kategorien.php" class="btn btn-secondary">Zurück</a>
    </form>
</div>

</body>
</html>
