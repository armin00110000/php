<?php
require_once '../verbindung/db.php';

// Bestellung ID aus URL holen
$bestellung_id = $_GET['id'] ?? 0;

// Status auf "abgeschlossen" setzen wenn gedruckt wird
if (isset($_POST['drucken'])) {
    $cmd = $pdo->prepare("UPDATE bestellung SET status = 'abgeschlossen' WHERE bestellung_id = ?");
    $cmd->execute([$bestellung_id]);
    // Seite neu laden damit Status aktualisiert wird
    header("Location: rechnung.php?id=" . $bestellung_id . "&gedruckt=1");
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

// MwSt berechnen (19%)- wenn Zeit bleibt und ich nicht vergesse werde für speisen 7% und getränke 19% rechnen
$netto = $bestellung['gesamtpreis'] / 1.19;
$mwst = $bestellung['gesamtpreis'] - $netto;
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Rechnung</title>
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="no-print mb-3">
            <a href="bestellung_details.php?id=<?= $bestellung_id ?>" class="btn btn-secondary">← Zurück</a>
            <!--wenn Status offen-->
            <?php if ($bestellung['status'] == 'offen'): ?>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="drucken" class="btn btn-primary" 
                            onclick="window.print()">
                        Drucken & Abschließen
                    </button>
                </form>
                <!--wenn status abgeschlossen oder storniert-->
            <?php else: ?>
                <button onclick="window.print()" class="btn btn-primary">Drucken</button>
                <span class="badge bg-success ms-2">Bestellung abgeschlossen</span>
            <?php endif; ?>
            
            <?php if (isset($_GET['gedruckt'])): ?>
                <div class="alert alert-success mt-3">
                    Bestellung wurde als abgeschlossen markiert!
                </div>
            <?php endif; ?>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h2 class="text-center">Restaurant Bestellando</h2>
                <p class="text-center">Hauptstraße 123, 12345 Berlin</p>
                <p class="text-center">Tel: 0123-456789</p>
                <hr>
                
                <h3>Rechnung</h3>
                <p><strong>Bestellung #<?= $bestellung['bestellung_id'] ?></strong></p>
                <p><strong>Tisch:</strong> <?= $bestellung['tischnummer'] ?></p>
                <p><strong>Datum:</strong> <?= date('d.m.Y') ?></p>
                <p><strong>Uhrzeit:</strong> <?= date('H:i') ?> Uhr</p>
                
                <hr>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Anzahl</th>
                            <th>Bezeichnung</th>
                            <th class="text-end">Einzelpreis</th>
                            <th class="text-end">Gesamt</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($positionen as $position): ?>
                            <tr>
                                <td><?= $position['anzahl'] ?>x</td>
                                <td><?= htmlspecialchars($position['name']) ?></td>
                                <td class="text-end"><?= number_format($position['einzelpreis'], 2, ',', '.') ?> €</td>
                                <td class="text-end"><?= number_format($position['einzelpreis'] * $position['anzahl'], 2, ',', '.') ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <hr>
                
                <div class="row">
                    <div class="col text-end">
                        <p><strong>Netto:</strong> <?= number_format($netto, 2, ',', '.') ?> €</p>
                        <p><strong>MwSt. (19%):</strong> <?= number_format($mwst, 2, ',', '.') ?> €</p>
                        <h4><strong>Gesamtbetrag:</strong> <?= number_format($bestellung['gesamtpreis'], 2, ',', '.') ?> €</h4>
                    </div>
                </div>
                
                <hr>
                
                <p class="text-center">Vielen Dank für Ihren Besuch!</p>
                <p class="text-center"><small>Alle Preise inkl. MwSt.</small></p>
            </div>
        </div>
    </div>
</body>
</html>