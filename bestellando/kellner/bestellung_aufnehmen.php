<?php
include '../auth/login_control.php'; //login kontrolle einbinden
require_once '../verbindung/db.php';

// Tische laden
$tische = $pdo->query("SELECT * FROM tisch ORDER BY tischnummer")->fetchAll();

// Gerichte nach Kategorie laden
$gerichte = $pdo->query("SELECT * FROM gericht ORDER BY kategorie, name")->fetchAll();

// Kategorien für Gruppierung
$kategorien = [];
foreach ($gerichte as $gericht) {
    $kategorien[$gericht['kategorie']][] = $gericht;
}

// Bestellung speichern
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tisch_id'])) {
    $tisch_id = $_POST['tisch_id'];
    
    // Neue Bestellung erstellen
    $cmd = $pdo->prepare("INSERT INTO bestellung (tisch_id, status, gesamtpreis) VALUES (?, 'offen', 0)");
    $cmd->execute([$tisch_id]);
    $bestellung_id = $pdo->lastInsertId();
    
    $gesamtpreis = 0;
    
    // Bestellpositionen einfügen
    foreach ($_POST['anzahl'] as $gericht_id => $anzahl) {
        if ($anzahl > 0) {
            $gericht = $pdo->prepare("SELECT preis FROM gericht WHERE gericht_id = ?");
            $gericht->execute([$gericht_id]);
            $preis = $gericht->fetchColumn();
            
            $cmd = $pdo->prepare("INSERT INTO bestellposition (bestellung_id, gericht_id, anzahl, einzelpreis) VALUES (?, ?, ?, ?)");
            $cmd->execute([$bestellung_id, $gericht_id, $anzahl, $preis]);
            
            $gesamtpreis += $preis * $anzahl;
        }
    }
    
    // Gesamtpreis aktualisieren
    $cmd = $pdo->prepare("UPDATE bestellung SET gesamtpreis = ? WHERE bestellung_id = ?");
    $cmd->execute([$gesamtpreis, $bestellung_id]);
    
    header("Location: ../bestellung/bestelluebersicht.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bestellung aufnehmen</title>
</head>
<body>
    <div class="text-end m-3" style="text-align: right;">
    <a href="../auth/logout.php" class="btn btn-danger">Logout</a>
  </div>
    <div class="container mt-4">
        <h1>Bestellung aufnehmen</h1>
        <a href="../index.php" class="btn btn-secondary mb-3">← Zurück</a>
        <!-- Bestellformular -->
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Tischnummer:</label>
                <select name="tisch_id" class="form-select" required>
                    <option value="">Tisch wählen...</option>
                    <?php foreach ($tische as $tisch): ?>
                        <option value="<?= $tisch['tisch_id'] ?>">Tisch <?= $tisch['tischnummer'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <h3>Speisekarte</h3>
            <?php foreach ($kategorien as $kategorie => $items): ?>
                <h4 class="mt-4"><?= htmlspecialchars($kategorie) ?></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Gericht</th>
                            <th>Preis</th>
                            <th>Anzahl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Gerichte der Kategorie durchgehen -->
                        <?php foreach ($items as $gericht): ?>
                            <tr>
                                <td><?= htmlspecialchars($gericht['name']) ?></td>
                                <td><?= number_format($gericht['preis'], 2, ',', '.') ?> €</td>
                                <td>
                                    <input type="number" name="anzahl[<?= $gericht['gericht_id'] ?>]" 
                                           class="form-control" style="width: 80px;" 
                                           min="0" value="0">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
            
            <button type="submit" class="btn btn-success btn-lg mt-3">Bestellung absenden</button>
        </form>
    </div>
</body>
</html>