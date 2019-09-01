<?php
#Funktion zur Anzeige von Bildern
include ("auth.php");

$host="localhost";
$user="m2027751";
$pw=".QODbkFl";
$dbname="m2027751";
$db = mysqli_connect($host,$user,$pw,$dbname);

#Speichern der Übergebenen ProduktID und BildID
$id=(int)$_GET['id'];
$bild_id=(int)$_GET['bild_id'];
if ($id != 0)
{
$anfrage = "SELECT Bezeichnung, Bild.Bild, Bild_Typ
			FROM Produkt
			INNER JOIN
				(SELECT * FROM Produkt_Bild WHERE Produkt_Bild.ProduktID = '$id') AS Produkt_Bild
			ON
				Produkt.ProduktID = Produkt_Bild.ProduktID
			INNER JOIN
				Bild
			ON
				Produkt_Bild.BildID = Bild.BildID";
}
if ($bild_id != 0){
	$anfrage = "SELECT Bild
			FROM Bild
			WHERE BildID = $bild_id";
}
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
header("content-type: ".$row["Bild_Typ"]);
if ($num ==0 )
{
	header("content-type: text/html; char-set:utf-8");
	echo "Keine Bilder vorhanden";
}

		echo $row["Bild"];

	header("content-type: text/html; char-set:utf-8");


?>