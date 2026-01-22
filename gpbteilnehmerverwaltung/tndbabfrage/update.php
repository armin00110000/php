<?php
include '../db/dbverbindung.php';

if (isset($_POST['aktualisieren'])) {
    //Eingabedaten aus dem Formular holen und bereinigen
    $idnummer = htmlspecialchars($_POST['id']);
    $vorname = htmlspecialchars($_POST['vorname']);
    $nachname = htmlspecialchars($_POST['nachname']);
    $email = htmlspecialchars($_POST['email']);

    //SQL-Update-Befehl vorbereiten
    $sql = "UPDATE teilnehmer SET Vorname=?, Nachname=?, email=? WHERE tID=?";
    //Prepared Statement
    $cmd = $verbindung->prepare($sql);

    //Update-Befehl mit Daten ausführen
    $cmd->execute([$vorname, $nachname, $email, $idnummer]);

    //Weiterleitung zurück zur Teilnehmerliste
    header("Location: ../index.php");
    exit();
}
?>