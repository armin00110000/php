<?php
session_start();
//Session beenden
session_destroy();
//Weiterleitung zur Login-Seite
header("Location: ../login.php");
exit();
?>