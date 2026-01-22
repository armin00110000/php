<?php
            //Session starten
            session_start();
            include '../verbindung/db.php';
        if(isset($_POST['login'])){
            //Eingabedaten aus dem Formular holen und bereinigen
            $admin=htmlspecialchars($_POST['user']);
            $passwort=htmlspecialchars($_POST['passwort']);

            //SQL abfrage
            $sql="SELECT * FROM admin WHERE user=?";
            $cmd=$pdo->prepare($sql);
            $cmd->execute([$admin]);
        

   //Überprüfung ob Benutzer existiert
   if($cmd->rowCount() > 0) {
        //Admin Datei
        $admin=$cmd->fetch();
   
        //Passwort überprüfen
        if(password_verify($passwort, $admin['passwort'])) {

            
            //Benutzerinformationen in Session speichern
            $_SESSION['benutzer_id']=$admin['aID'];
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