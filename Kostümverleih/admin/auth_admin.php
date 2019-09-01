<!-- funktion zur Authentifizierung des Mitarbeiters -->
<?php
SESSION_START();
if ($_SESSION["login"] == 0 || !$_SESSION["login"] || $_SESSION["admin"] != 1 )
	
	{
		echo "<p align=center><font color='red'>Inhalt nur für angemeldete Mitarbeiter sichtbar</p></font>";
		include ("../login.php");
		exit;
	} 
?>