
<?php
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
    <br><br><br>
    <h1 class="text-center">Willkommen bei Bestellando</h1>
    <br><br><br>
    <div class="container text-center" style="max-width: 600px; background-color: #0bb630; padding: 20px; border-radius: 10px;">
  <!--login formular    -->
  <form action="auth/login.php" method="post" style="max-width: 50%;background-color: #03771c; margin: auto; border-radius: 5%;">
    <div class="mb-3">
      <label for="user" class="form-label fw-bold" style="color: yellow;">Benutzername</label>
      <input type="text" class="form-control" id="user" name="user" style="width: 90%; margin: auto;" required>
    </div>
    <div class="mb-3">
      <label for="passwort" class="form-label fw-bold" style="color: yellow;">Passwort</label>
      <input type="password" class="form-control" id="passwort" name="passwort" style="width: 90%; margin: auto;" required>
    </div>
    <button type="submit" name="login" class="btn btn-warning">Login</button>
</div>
    </form>
    <!--Fehlermeldungen-->
    <div class="text-center mt-3">
    <?php
            if(isset($_GET['passwort'])){
                echo '<p class="alert alert-danger m-3" role="alert">
                    Falsches Passwort!
                </p>';
            }
            if(isset($_GET['username'])){
                echo '<p class="alert alert-danger m-3" role="alert">
                    Benutzer nicht gefunden!
                </p>';
            }
            ?>
  </div>
  <br><br>
  
</body>
</html>