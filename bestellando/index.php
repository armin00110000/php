<?php
//wenn nicht angemeldet, weiterleiten zur login seite
session_start();
if(!isset($_SESSION['benutzer_id'])){
    header("Location: login.php");
    exit();
}
include 'verbindung/db.php';
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bestellando</title>
</head>
<body>
  <div class="text-end m-3" style="text-align: right;">
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
    <br><br><br>
    <h1 class="text-center">Willkommen bei Bestellando</h1>
    <br><br><br>
    <div class="container text-center" style="max-width: 600px; background-color: #0bb630; padding: 20px; border-radius: 10px;">
  <div class="row">
    <div class="col">
      <a href="bestellung/bestelluebersicht.php" class="btn btn-success">Bestellübersicht</a>
    </div>
    <div class="col">
      <a href="kellner/bestellung_aufnehmen.php" class="btn btn-success">Bestellung aufnehmen</a>
    </div>
    <div class="col">
      <a href="kueche/kueche.php" class="btn btn-success">Küche</a>
    </div>
  </div>
</div>
</body>
</html>