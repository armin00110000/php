<?php
include '../verbindung/db.php';
$kategorie_id = $_POST['kategorie_id'];
$kategorie_name = $_POST['kategorie_name'];
$sql = "UPDATE kategorie SET kName = ? WHERE kID = ?";
$cmd = $verbindung->prepare($sql);
$cmd->execute([$kategorie_name, $kategorie_id]);
header("Location: ../kategorien.php");
exit();
?>