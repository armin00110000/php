<?php
session_start();
if(!isset($_SESSION['benutzer_id'])) {
    header("location:login.php");
    exit();
}
include '../db/dbverbindung.php';
if(isset($_GET['tidnummer'])){
    $tID=htmlspecialchars($_GET['tidnummer']);
    //SQL-Löschbefehl
    $sql="DELETE FROM teilnehmer WHERE tID=?";
    $cmd=$verbindung->prepare($sql);
    $cmd->execute([$tID]);

    

    //Weiterleitung zurück zur Hauptseite
    header("Location: ../index.php");
    exit();
}


?>