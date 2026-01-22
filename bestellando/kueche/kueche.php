<?php
require_once '../verbindung/db.php';

// Nur offene Bestellungen laden
$sql = "SELECT b.*, t.tischnummer 
        FROM bestellung b 
        JOIN tisch t ON b.tisch_id = t.tisch_id 
        WHERE b.status = 'offen'
        ORDER BY b.bestellung_id ASC";
$bestellungen = $pdo->query($sql)->fetchAll();
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Küche - Offene Bestellungen</title>
    <meta http-equiv="refresh" content="120"> <!--aktualiesiert alle 2 minuten-->
</head>
<body>
    <div class="container mt-4">
        <h1>Küche - Offene Bestellungen</h1>
        <a href="../index.php" class="btn btn-secondary mb-3">← Zurück</a>
        
        <div class="alert alert-info">
            Anzahl offener Bestellungen: <?= count($bestellungen) ?>
        </div>

        <?php if (count($bestellungen) > 0): ?>
            <?php foreach ($bestellungen as $bestellung): ?>
                <?php
                // Bestellpositionen für diese Bestellung laden (OHNE Getränke)
                $sql = "SELECT bp.*, g.name, g.kategorie 
                        FROM bestellposition bp 
                        JOIN gericht g ON bp.gericht_id = g.gericht_id 
                        WHERE bp.bestellung_id = ? AND g.kategorie != 'Getränk'
                        ORDER BY g.kategorie, g.name";
                $cmd = $pdo->prepare($sql);
                $cmd->execute([$bestellung['bestellung_id']]);
                $positionen = $cmd->fetchAll();
                ?>
                
                <div class="card mb-3">
                    <div class="card-header bg-warning">
                        <h4>Bestellung #<?= $bestellung['bestellung_id'] ?> - Tisch <?= $bestellung['tischnummer'] ?></h4>
                    </div>
                    <div class="card-body">
                        <?php if (count($positionen) > 0): ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Anzahl</th>
                                        <th>Gericht</th>
                                        <th>Kategorie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($positionen as $position): ?>
                                        <tr>
                                            <td><strong><?= $position['anzahl'] ?>x</strong></td>
                                            <td><?= htmlspecialchars($position['name']) ?></td>
                                            <td><span class="badge bg-secondary"><?= htmlspecialchars($position['kategorie']) ?></span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            
                            <p class="text-muted">Nur Getränke - keine Küchenzubereitung nötig</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-success">
                <h4>Keine offenen Bestellungen!</h4>
                <p>Momentan sind alle Bestellungen abgearbeitet.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>