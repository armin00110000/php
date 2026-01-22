<?php
include '../verbindung/db.php';
$id = $_GET['kid'];
$sql = "DELETE FROM kategorie WHERE kID = ?";
$cmd = $verbindung->prepare($sql);
$cmd->execute([$id]);
header("Location: ../kategorien.php");
exit();
?>