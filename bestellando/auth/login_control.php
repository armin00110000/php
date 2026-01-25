<?php
//wenn nicht angemeldet, weiterleiten zur login seite
session_start();
if(!isset($_SESSION['benutzer_id'])){
    header("Location: ../login.php");
    exit();
}

?>