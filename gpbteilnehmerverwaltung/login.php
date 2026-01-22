<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPB Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar { background-color: #0055a5; } 
        .card { box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <nav class="navbar navbar-dark mb-5">
        <div class="container">
            <span class="navbar-brand mb-0 h1">GPB | Login</span>
        </div>
    </nav>

    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 400px;">
            <div class="card-header bg-primary text-white">
                Anmeldung
            </div>
            <div class="card-body">
                <form method="post" action="auth/login.php">
                    <div class="mb-3">
                        <label class="form-label">Benutzername</label>
                        <input type="text" name="benutzername" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passwort</label>
                        <input type="password" name="passwort" class="form-control">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Einloggen</button>
                </form>
                <div class="mt-3 text-center">
                    <a href="register.php">Noch keinen Account?</a>
                </div>
            </div>
            <?php
            if(isset($_GET['passwort'])){
                echo '<p class="alert alert-danger m-3" role="alert">
                    Falsches Passwort!
                </p>';
            }
            if(isset($_GET['benutzer'])){
                echo '<p class="alert alert-danger m-3" role="alert">
                    Benutzer nicht gefunden!
                </p>';
            }
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>