<?php
include '../verbindung/db.php';
$id = $_GET['artid'];
$sql = "DELETE FROM artikel WHERE artID = ?";
$cmd = $verbindung->prepare($sql);
$cmd->execute([$id]);
header("Location: ../index.php");
exit();
?>