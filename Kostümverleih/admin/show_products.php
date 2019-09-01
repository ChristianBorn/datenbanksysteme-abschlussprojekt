<!-- Funktion zur Anzeige der Produkte -->
<?php
include ("auth_admin.php");
#Abfrage der eingetragenen Produkte
$anfrage = "SELECT *
			from Produkt";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Falls keine Produkte eingetragen -> Fehlermeldung
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
                <h3>Alle Produkte</h3>
            </td>
        </tr>';
    echo '<th>Bilder</th>';
    echo '<th>ProduktID</th>';
	echo '<th>Bezeichnung</th>';
	echo '<th>Beschreibung</th>';
	echo '<th>Mietpreis</th>';
	echo '<th>Lieferumfang</th>';
	echo '<th>Geschlecht</th>';
	echo '<th>Art</th>';
	echo '<th>Anlässe</th>';
	echo '<th>Themen</th>';
	echo '<th>Passende Produkte</th>';
	while($row=mysqli_fetch_assoc($result))
	{
		echo '<tr>';
		echo '<td><img src="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/admin/show_images.php?id='.$row['ProduktID'].'"'.'height="200px" width="200px"></td>';
		echo '<td>'.$row['ProduktID'].'</td>';
		echo '<td>'.$row['Bezeichnung'].'</td>';
		echo '<td>'.nl2br($row['Beschreibung']).'</td>';
		echo '<td>'.$row['Mietpreis'].'</td>';
		echo '<td>'.nl2br($row['Lieferumfang']) .'</td>';
		echo '<td>'.$row['Geschlecht'].'</td>';
		echo '<td>'.$row['Art'] .'</td>';
		#Link zur Zuordnung von Anlässen
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=category_occasion&id='.$row['ProduktID'].'"'.'>Anlässe hinzufügen</a></td>';
		#Link zur Zuordnung von Themen
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=category_theme&id='.$row['ProduktID'].'"'.'>Themen hinzufügen</a></td>';
		#Link zur Zuordnung von passenend Produkten
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=category_product&id='.$row['ProduktID'].'"'.'>Passende Produkte hinzufügen</a></td>';
		#Link zum Hinzufügen von Bildern
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=add_image&id='.$row['ProduktID'].'"'.'>Bild hinzufügen</a></td>';
		##Link zur Bearbeitung des Produkts
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=update_product&id='.$row['ProduktID'].'"'.'>Bearbeiten oder Löschen</a></td>';
		#Link zur Anzeige weiterer Bilder
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=images&id='.$row['ProduktID'].'"'.'>Bilder anzeigen</a></td>';
		
		
	}
}
?>
</table>