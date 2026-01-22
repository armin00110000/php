<?php
            //Session starten
            session_start();
            include '../db/dbverbindung.php';
        if(isset($_POST['login'])){
            //Eingabedaten aus dem Formular holen und bereinigen
            $benutzername=htmlspecialchars($_POST['benutzername']);
            $passwort=htmlspecialchars($_POST['passwort']);

            //SQL abfrage
            $sql="SELECT * FROM benutzer WHERE benutzername=?";
            $cmd=$verbindung->prepare($sql);
            $cmd->execute([$benutzername]);
        

   //Überprüfung ob Benutzer existiert
   if($cmd->rowCount() > 0) {
        //Benutzer Datei
        $benutzer=$cmd->fetch();
   
        //Passwort überprüfen
        if(password_verify($passwort, $benutzer['passwort'])) {

            
            //Benutzerinformationen in Session speichern
            $_SESSION['benutzer_id']=$benutzer['bid'];
            //$_SESSION['benutzername']=$benutzer['benutzername'];
            header("Location: ../index.php");
            exit();
                } else {
            //Fehlermeldung bei falschem Passwort
            header("Location: ../login.php?passwort=false");
            exit();
        }
        } else {
        //Fehlermeldung bei nicht vorhandenem Benutzer
        header("Location: ../login.php?benutzer=false");
        exit();
       
    } 
}

?>