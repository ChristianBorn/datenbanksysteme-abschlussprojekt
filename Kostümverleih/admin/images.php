<!-- Funktion zur Anzeige aller Bilder, die zum Produkt gehören -->
<?php
include ("auth.php");
#Speichern der ProduktID
$id=(int)$_GET['id'];
#Abfrage aller zum Produkt zugeordneten Bilder
$anfrage = "SELECT Bild.BildID, Bild_Typ 
			from Bild
			INNER JOIN
				Produkt_Bild
			ON
				Bild.BildID = Produkt_Bild.BildID
			WHERE Produkt_Bild.ProduktID = '$id'";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Falls keine Bilder für das Produkt vorhanden -> Fehlermeldung
if ($num == 0) 
{
	echo "<p align='center'>keine Datensätze gefunden!</p>";
}
else 
{
	echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
			style="border-collapse:collapse">        
		<tr>
            <td align="center" colspan="2">
                <h3>Bilder zum Produkt</h3>
            </td>
        </tr>';
	echo '<th>Bild ID</th>';
	echo '<th>Bild Typ</th>';

	while($row=mysqli_fetch_assoc($result))
	{
		echo '<tr>';
		echo '<td>'.$row['BildID'].'</td>';
		echo '<td>'.$row['Bild_Typ'].'</td>';
		#Link zum Anzeigen des gewählten Bildes
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/admin/show_images.php?&bild_id='.$row['BildID'].'"'.'>Bild anzeigen</a></td>';

	}
}
?>
</table>