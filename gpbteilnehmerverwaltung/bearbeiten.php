<?php
session_start();
if(!isset($_SESSION['benutzer_id'])) {
    header("location:login.php");
    exit();
}
include 'db/dbverbindung.php';
//Array für Teilnehmerdaten initialisieren
$tninfo="";
if(isset($_GET['tidnummer'])){
    $tid=htmlspecialchars($_GET['tidnummer']);
    //Daten des Teilnehmers aus der Datenbank holen
    $sql="SELECT * FROM teilnehmer WHERE tID=?";
    $cmd=$verbindung->prepare($sql);
    $cmd->execute([$tid]);
    //datei in array speichern
    $tninfo=$cmd->fetch(PDO::FETCH_ASSOC);
    //testausgabe
    //print_r($tninfo);
   
}
 //Variablen mit Teilnehmerdaten füllen
    $vorname=$tninfo['Vorname'];
    $nachname=$tninfo['Nachname'];
    $email=$tninfo['email'];
    $idnummer=$tninfo['tID'];
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teilnehmer bearbeiten | GPB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #0055a5; }
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 50px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand mb-0 h1">GPB | Teilnehmerverwaltung</span>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                
                <a href="index.php" class="btn btn-secondary mb-3">← Zurück zur Liste</a>

                <div class="card">
                    <div class="card-header bg-warning text-dark fw-bold">
                        Teilnehmer-Daten bearbeiten
                    </div>
                    <div class="card-body">
                        <form method="post" action="tndbabfrage/update.php">
                            <input type="hidden" name="id" value="<?php echo $idnummer; ?>">

                            <div class="mb-3">
                                <label class="form-label">Vorname</label>
                                <input type="text" name="vorname" class="form-control" value="<?php echo $vorname; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nachname</label>
                                <input type="text" name="nachname" class="form-control" value="<?php echo $nachname; ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">E-Mail</label>
                                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="aktualisieren" class="btn btn-primary">Änderungen speichern</button>
                                <a href="index.php" class="btn btn-outline-danger">Abbrechen</a>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>