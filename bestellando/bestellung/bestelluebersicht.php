<?php
include '../auth/login_control.php'; //sicherstellen, dass nur angemeldete benutzer zugreifen können
require_once '../verbindung/db.php';

// Alle Bestellungen laden mit Tischinformationen
$sql = "SELECT b.*, t.tischnummer 
        FROM bestellung b 
        JOIN tisch t ON b.tisch_id = t.tisch_id 
        ORDER BY b.bestellung_id DESC";
$bestellungen = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bestellübersicht</title>
</head>
<body>
    <div class="text-end m-3" style="text-align: right;">
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
  </div>
    <div class="container mt-4">
        <h1>Bestellübersicht</h1>
        <a href="../index.php" class="btn btn-secondary mb-3">← Zurück</a>
        
        <?php if (count($bestellungen) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Bestellung #</th>
                        <th>Tisch</th>
                        <th>Status</th>
                        <th>Gesamtpreis</th>
                        <th>Bearbeiten</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Bestellungen durchgehen und anzeigen -->
                    <?php foreach ($bestellungen as $bestellung): ?>
                        <tr>
                            <td><?= $bestellung['bestellung_id'] ?></td>
                            <td>Tisch <?= $bestellung['tischnummer'] ?></td>
                            <td>
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
                            </td>
                            <td><?= number_format($bestellung['gesamtpreis'], 2, ',', '.') ?> €</td>
                            <td>
                                <a href="bestellung_details.php?id=<?= $bestellung['bestellung_id'] ?>" 
                                   class="btn btn-sm btn-primary">Details</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">
                Keine Bestellungen vorhanden.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>