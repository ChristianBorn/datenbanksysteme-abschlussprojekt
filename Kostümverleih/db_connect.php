<?php
#Herstellen einer Datenbankverbindung
$host="localhost";
$user="m2027751";
$pw=".QODbkFl";
$dbname="m2027751";

$db = mysqli_connect($host,$user,$pw,$dbname) or die("<center><h1>Keine Verbindung hergestellt!</h1></center>".mysqli_error());
SESSION_START();
?>


