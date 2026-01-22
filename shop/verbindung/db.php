<?php
$host="localhost";
$benutzer="root";
$db="onlineshop";
$pass="";

try{
    $verbindung=new PDO("mysql:host=$host;dbname=$db;charset=utf8",$benutzer,$pass);
}
catch(PDOException $e){
    echo "Verbindungsfehler: ".$e->getMessage();
}

?>