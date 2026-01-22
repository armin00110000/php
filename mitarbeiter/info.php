<?php
    $name ="";
    $abteilung="";
    $vertrag ="";
    $austattung=[];
    $fehler=[];
    $austattungtext="";
    //ob wir auf speichern 
    if(isset($_POST['speichern'])){
        if(!empty($_POST['vornachname'])){
            $name=htmlspecialchars($_POST['vornachname']);
        }else{
            $fehler[]="Vor und Nachname fehlt!";
        }
        $abteilung = htmlspecialchars($_POST['abteilung']);
        $vertrag = htmlspecialchars($_POST['vertragsart']);
        if(isset($_POST['ausstattung'])){
        $austattung = $_POST['ausstattung']; //array("Laptop", "Drucker") // ["Laptop", "Drucker"]
        //jedes Element säubern => Laptop  - Drucker, ...
        $austattungtext = htmlspecialchars(implode(", ", $austattung));
        }else{
            $fehler[]="Ausstattung fehlt!";
        }
    }
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mitarbeiter Info</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #00c6ff 0%, #0072ff 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        h1 { color: #333; text-align: center; margin-top: 0; }
        
        .result-box {
            background-color: #f0f8ff;
            border-left: 5px solid #0072ff;
            padding: 15px;
            margin-top: 20px;
            border-radius: 4px;
        }
        .result-item { margin-bottom: 10px; color: #333; }
        .label { font-weight: bold; color: #555; }
        
        .btn-back {
            display: block; width: 100%; text-align: center; margin-top: 20px;
            padding: 12px; background-color: #666; color: white;
            text-decoration: none; border-radius: 8px; box-sizing: border-box; 
        }
        .btn-back:hover { background-color: #444; }
    </style>
</head>
<body>

    <div class="card">
        <h1>✅ Mitarbeiter Info</h1>
        
        <div class="result-box">
            <div class='result-item'>
                <span class='label'>Name:</span> <?php echo $name;?> 
            </div>
            <div class='result-item'>
                <span class='label'>Abteilung:</span> <?php echo $abteilung;?>
            </div>
            <div class='result-item'>
                <span class='label'>Vertrag:</span> <?php echo $vertrag;?>
            </div>
            <div class='result-item'>
                <span class='label'>Ausstattung:</span> <?php echo $austattungtext;?>
            </div>
        </div>

        <a href="index.php" class="btn-back">Zurück</a>
    </div>

</body>
</html>