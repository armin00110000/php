<?php
require_once '../verbindung/db.php';

// Bestellung ID aus URL holen
$bestellung_id = $_GET['id'] ?? 0;

// Bestellung laden
$sql = "SELECT b.*, t.tischnummer 
        FROM bestellung b 
        JOIN tisch t ON b.tisch_id = t.tisch_id 
        WHERE b.bestellung_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$bestellung_id]);
$bestellung = $stmt->fetch();

if (!$bestellung || $bestellung['status'] != 'offen') {
    header("Location: bestelluebersicht.php");
    exit;
}

// Aktuelle Bestellpositionen laden
$sql = "SELECT * FROM bestellposition WHERE bestellung_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$bestellung_id]);
$aktuelle_positionen = $stmt->fetchAll();

// Array für schnellen Zugriff auf Anzahl pro Gericht
$anzahl_map = [];
foreach ($aktuelle_positionen as $pos) {
    $anzahl_map[$pos['gericht_id']] = $pos['anzahl'];
}

// Gerichte nach Kategorie laden
$gerichte = $pdo->query("SELECT * FROM gericht ORDER BY kategorie, name")->fetchAll();

// Kategorien für Gruppierung
$kategorien = [];
foreach ($gerichte as $gericht) {
    $kategorien[$gericht['kategorie']][] = $gericht;
}

// Bestellung aktualisieren
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Alte Positionen löschen
    $stmt = $pdo->prepare("DELETE FROM bestellposition WHERE bestellung_id = ?");
    $stmt->execute([$bestellung_id]);
    
    $gesamtpreis = 0;
    
    // Neue Bestellpositionen einfügen
    foreach ($_POST['anzahl'] as $gericht_id => $anzahl) {
        if ($anzahl > 0) {
            $gericht = $pdo->prepare("SELECT preis FROM gericht WHERE gericht_id = ?");
            $gericht->execute([$gericht_id]);
            $preis = $gericht->fetchColumn();
            
            $stmt = $pdo->prepare("INSERT INTO bestellposition (bestellung_id, gericht_id, anzahl, einzelpreis) VALUES (?, ?, ?, ?)");
            $stmt->execute([$bestellung_id, $gericht_id, $anzahl, $preis]);
            
            $gesamtpreis += $preis * $anzahl;
        }
    }
    
    // Gesamtpreis aktualisieren
    $stmt = $pdo->prepare("UPDATE bestellung SET gesamtpreis = ? WHERE bestellung_id = ?");
    $stmt->execute([$gesamtpreis, $bestellung_id]);
    
    header("Location: bestellung_details.php?id=" . $bestellung_id);
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Bestellung bearbeiten</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Bestellung bearbeiten</h1>
        <a href="bestellung_details.php?id=<?= $bestellung_id ?>" class="btn btn-secondary mb-3">← Zurück</a>
        
        <div class="alert alert-info">
            Bestellung #<?= $bestellung['bestellung_id'] ?> - Tisch <?= $bestellung['tischnummer'] ?>
        </div>
        
        <form method="POST">
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
                        <?php foreach ($items as $gericht): ?>
                            <tr>
                                <td><?= htmlspecialchars($gericht['name']) ?></td>
                                <td><?= number_format($gericht['preis'], 2, ',', '.') ?> €</td>
                                <td>
                                    <input type="number" 
                                           name="anzahl[<?= $gericht['gericht_id'] ?>]" 
                                           class="form-control" 
                                           style="width: 80px;" 
                                           min="0" 
                                           value="<?= $anzahl_map[$gericht['gericht_id']] ?? 0 ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
            
            <button type="submit" class="btn btn-success btn-lg mt-3">Änderungen speichern</button>
            <a href="bestellung_details.php?id=<?= $bestellung_id ?>" class="btn btn-secondary btn-lg mt-3">Abbrechen</a>
        </form>
    </div>
</body>
</html>