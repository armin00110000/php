<?php
include '../db/dbverbindung.php';
if(isset($_POST['register'])){
    //Eingabedaten aus dem Formular holen und bereinigen
    $benutzername=htmlspecialchars($_POST['benutzername']);
    $passwort1=htmlspecialchars($_POST['passwort1']);
    $passwort2=htmlspecialchars($_POST['passwort2']);

    //Passwörter vergleichen
    if($passwort1 === $passwort2 && strlen($passwort1) >= 8){
        //Passwort hashen (sicher machen)
        $sicherpass=password_hash($passwort1, PASSWORD_DEFAULT);
        //password_verify($passwort1, $sicherpass); //zum Überprüfen

        //SQL-Insert-Befehl
        $sql="INSERT INTO benutzer (benutzername, passwort) VALUES (?, ?)";
        $cmd=$verbindung->prepare($sql);
        $cmd->execute([$benutzername, $sicherpass]);

        //Weiterleitung zum Login
        header("Location: ../login.php");
        exit();
    } else {
        header("Location: ../register.php?pass=false");
        exit();
    }
}
?>