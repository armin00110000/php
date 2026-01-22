<?php
include '../db/dbverbindung.php';

if(isset($_POST['speichern'])){
    //Daten aus dem Formular holen
    $vorname=$_POST['vorname'];
    $nachname=$_POST['nachname'];
    $email=$_POST['email'];

    //SQL-Insert-Befehl
    $sql="INSERT INTO teilnehmer (vorname, nachname, email) VALUES (?, ?, ?)"; //geht  auch mit :vorname, :nachname, :email
    $cmd=$verbindung->prepare($sql);
    $cmd->execute([$vorname, $nachname, $email]); 

    //Weiterleitung zurück zur Hauptseite
    header("Location: ../index.php");
    exit();
}
?>