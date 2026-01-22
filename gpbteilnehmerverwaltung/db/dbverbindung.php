<?php
$host='localhost';
$db="teilnehmerdb";
$benutzer="root";
$pass="";

try{
    //Verbindung zur Datenbank aufbauen PDO(parameter1,parameter2,parameter3)
    //parameter1: DB-Typ, Host, DB-Name; parameter2: Benutzername; parameter3: Passwort
    $verbindung=new PDO("mysql:host=$host;dbname=$db;charset=utf8",$benutzer,$pass);
}catch(PDOException $e){
    //wenn Fehler gibt
    die("Fehler bei der Verbindung zur Datenbank: ".$e->getMessage());
}


?>