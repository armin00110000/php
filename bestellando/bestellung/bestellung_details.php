<?php
include '../auth/login_control.php';
require_once '../verbindung/db.php';

// Bestellung ID aus URL holen
$bestellung_id = $_GET['id'] ?? 0;

// Bestellung stornieren
if (isset($_POST['stornieren'])) {
    $cmd = $pdo->prepare("UPDATE bestellung SET status = 'storniert' WHERE bestellung_id = ?");
    $cmd->execute([$bestellung_id]);
    header("Location: bestelluebersicht.php");
    exit;
}

// Bestellung laden
$sql = "SELECT b.*, t.tischnummer 
        FROM bestellung b 
        JOIN tisch t ON b.tisch_id = t.tisch_id 
        WHERE b.bestellung_id = ?";
$cmd = $pdo->prepare($sql);
$cmd->execute([$bestellung_id]);
$bestellung = $cmd->fetch();

if (!$bestellung) {
    header("Location: bestelluebersicht.php");
    exit;
}

// Bestellpositionen laden
$sql = "SELECT bp.*, g.name 
        FROM bestellposition bp 
        JOIN gericht g ON bp.gericht_id = g.gericht_id 
        WHERE bp.bestellung_id = ?";
$cmd = $pdo->prepare($sql);
$cmd->execute([$bestellung_id]);
$positionen = $cmd->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bestellung Details</title>
</head>
<body>
    <div class="text-end m-3" style="text-align: right;">
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
  </div>
    <div class="container mt-4">
        <h1>Bestellung Details</h1>
        <a href="bestelluebersicht.php" class="btn btn-secondary mb-3">← Zurück zur Übersicht</a>
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h3>Bestellung #<?= $bestellung['bestellung_id'] ?> - Tisch <?= $bestellung['tischnummer'] ?></h3>
            </div>
            <div class="card-body">
                <p><strong>Status:</strong> 
                    <?php
                    $badge_class = 'bg-warning';
                    if ($bestellung['status'] == 'abgeschlossen') {
                        $badge_class = 'bg-success';
                    } elseif ($bestellung['status'] == 'storniert') {
                        $badge_class = 'bg-danger';
                    }
                    ?>
                    <span class="badge <?= $badge_class ?>">
                        <?= ucfirst($bestellung['status']) ?>
                    </span>
                </p>
                
                <h4 class="mt-4">Bestellpositionen</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Anzahl</th>
                            <th>Gericht</th>
                            <th>Einzelpreis</th>
                            <th>Gesamt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Bestellpositionen durchgehen und anzeigen -->
                        <?php foreach ($positionen as $position): ?>
                            <tr>
                                <td><?= $position['anzahl'] ?>x</td>
                                <td><?= htmlspecialchars($position['name']) ?></td>
                                <td><?= number_format($position['einzelpreis'], 2, ',', '.') ?> €</td>
                                <td><?= number_format($position['einzelpreis'] * $position['anzahl'], 2, ',', '.') ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Gesamtpreis:</th>
                            <th><?= number_format($bestellung['gesamtpreis'], 2, ',', '.') ?> €</th>
                        </tr>
                    </tfoot>
                </table>
                <!-- Aktionen je nach Status -->
                <div class="mt-4">
                    <?php if ($bestellung['status'] == 'offen'): ?>
                        <a href="bestellung_bearbeiten.php?id=<?= $bestellung['bestellung_id'] ?>" 
                           class="btn btn-warning">Bearbeiten</a>
                        <!-- Stornieren mit Bestätigungsabfrage -->
                        <form method="POST" style="display: inline;" onsubmit="return confirm('Bestellung wirklich stornieren?')" >
                            <button type="submit" name="stornieren" class="btn btn-danger">Stornieren</button>
                        </form>
                    <?php endif; ?>
                    
                    <a href="rechnung.php?id=<?= $bestellung['bestellung_id'] ?>" 
                       class="btn btn-info">Rechnung anzeigen</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>