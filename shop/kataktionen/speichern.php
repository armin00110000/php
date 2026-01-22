<?php
include '../verbindung/db.php';

$kategorie_name = $_POST['kategorie'] ?? '';
$sql = "INSERT INTO kategorie (kName) VALUES (?)";
$cmd = $verbindung->prepare($sql);
$cmd->execute([$kategorie_name]);
header("Location: ../kategorien.php");
exit();
?>