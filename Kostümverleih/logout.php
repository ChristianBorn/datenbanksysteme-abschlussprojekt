<!-- Funktion zum Logout des aktuellen Users -->
<?php
include ("auth.php");
SESSION_START();
SESSION_DESTROY();
echo "<p align=center>Logout erfolgreich</p>";
#Weiterleitung zum Login
include ("login.php");
?>