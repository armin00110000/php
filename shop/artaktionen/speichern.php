<?php
include "../verbindung/db.php";

$name = $_POST['name'];;
$preis = $_POST['preis'];
//datentyp umwandeln
$double_preis = (float)str_replace(',', '.', $preis);
$kategorie = $_POST['kategorie'];

if(isset($_FILES['bild'])) {
    header("Location: ../produkt_hinzufuegen.php?keinebild=1");
    exit();
}
$maxgroesse = 5 * 1024 * 1024; //5MB
if($_FILES['bild']['size'] > $maxgroesse){
    header("Location: ../produkt_hinzufuegen.php?bildgroesse=zuhoch");
    exit();
}

$bildname = time()."_".$name."_".$_FILES['bild']['name'];
//datei hochladen
move_uploaded_file($_FILES['bild']['tmp_name'], "../uploads/".$bildname);

$sql = "INSERT INTO artikel (name, preis, bild, kategorieID) VALUES (?, ?, ?, ?)";
$cmd = $verbindung->prepare($sql);
$cmd->execute([$name, $double_preis, $bildname, $kategorie]);

header("Location: ../index.php");
exit();
?>