<?php
include '../verbindung/db.php';
$name = $_POST['name'];
$preis = $_POST['preis'];
$double_preis = (float)str_replace(',', '.', $preis);
$id = $_POST['artID'];
$kategorie = $_POST['kategorie'];
//$bildname = $_POST["bild"];
$bildname="";
if(isset($_FILES["bild"])){
    $bildname = time()."_".$name."_".$_FILES['bild']['name'];
    move_uploaded_file($_FILES['bild']['tmp_name'], "../uploads/".$bildname);
}else{
    //wenn kein neues bild hochgeladen wurde, dann altes bild beibehalten
    $cmd = $verbindung->prepare("SELECT bild FROM artikel WHERE artID = ?");
    $cmd->execute([$id]);
    $bildname = $cmd->fetchColumn();
}
$sql = "UPDATE artikel SET name = ?, preis = ?, bild = ?, kategorieID = ? WHERE artID = ?";

//bild parameters
$cmd = $verbindung->prepare($sql);
$cmd->execute([$name, $double_preis, $bildname, $kategorie, $id]);

header("Location: ../index.php");
exit();

?>