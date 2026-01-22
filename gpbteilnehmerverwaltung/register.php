<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPB Registrierung</title>
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
            <span class="navbar-brand mb-0 h1">GPB | Registrierung</span>
        </div>
    </nav>

    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 400px;">
            <div class="card-header bg-success text-white">
                Neuen Admin anlegen
            </div>
            <div class="card-body">
                <form method="post" action="auth/register.php">
                    <div class="mb-3">
                        <label class="form-label">Benutzername</label>
                        <input type="text" name="benutzername" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passwort</label>
                        <input type="password" name="passwort1" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Passwort wiederholen</label>
                        <input type="password" name="passwort2" class="form-control">
                    </div>
                    <button type="submit" name="register" class="btn btn-success w-100">Registrieren</button>
                </form>
                <?php
                if(isset($_GET['pass'] )){
                    ?>
                    <h2 class="alert alert-danger mt-3" role="alert">
                            Die Passwörter stimmen nicht überein oder sind zu kurz (mind. 8 Zeichen).
                          </h2>';
                    <?php
                }
                ?>
                <div class="mt-3 text-center">
                    <a href="login.php">Zurück zum Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>