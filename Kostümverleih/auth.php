<?php
#Authentifizierung des Users
SESSION_START();
if ($_SESSION["login"] == 0 || !$_SESSION["login"])
	{
		echo "<p align=center><font color='red'>Inhalt nur für angemeldete Mitglieder sichtbar</p></font>";
		include ("login.php");
		exit;
	} 
?>