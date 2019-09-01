<!-- Funktion zur Ausleihe eines Produkts; definiert zunächst nur das auszuleihende Produkt, noch nicht das Exemplar -->
<?php
include ("auth.php");
session_start();
$anfrage = "SELECT *
			from Produkt";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
if (is_null($produkt_id))
{
$produkt_id = $_GET["produkt_id"];
$_SESSION["produkt_id"] = $produkt_id; #Zwischenspeichern der ProduktID des gewählten Produkts
}
#Falls noch kein Produkt ausgewählt wurde, wird die Liste mit Produkten zur Ausleihe angezeigt
if (is_null($produkt_id))
{
	#Falls keine Produkte vorhanden sind -> Fehlermeldung
	if ($num == 0) 
	{
		echo "keine Datensätze gefunden!";
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
	    echo '<th>Bild</th>';
		echo '<th>Bezeichnung</th>';
		echo '<th>Beschreibung</th>';
		echo '<th>Mietpreis</th>';
		echo '<th>Lieferumfang</th>';
		echo '<th>Geschlecht</th>';
		echo '<th>Art</th>';
		while($row=mysqli_fetch_assoc($result))
		{
			echo '<tr>';
        	echo '<td><img src="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/admin/show_images.php?id='.$row['ProduktID'].'"'.'height="200px" width="200px"></td>';
			echo '<td>'.$row['Bezeichnung'].'</td>';
			echo '<td>'.nl2br($row['Beschreibung']).'</td>';
			echo '<td>'.$row['Mietpreis'].'</td>';
			echo '<td>'.nl2br($row['Lieferumfang']) .'</td>';
			echo '<td>'.$row['Geschlecht'].'</td>';
			echo '<td>'.$row['Art'] .'</td>';
			#Link zum Formular, um den Zeitraum der Ausleihe festzulegen
			echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=lend_time&produkt_id='.$row['ProduktID'].'"'.'>Ausleihen</a></td>';
			#Link zur Anzeige weiterer Bilder
			echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=images&id='.$row['ProduktID'].'"'.'>Bilder anzeigen</a></td>';

			
		}
		echo '</table>';
	}
}
#Falls ein Produkt durch Übergabe der ProduktID von lend_time.php ausgewählt wurde, 
#werden jetzt die für den ausgewählten Zeitraum verfügbaren Exemplare angezeigt
else
{
	include ("db_connect.php");
	#Abfrage der Exemplare zum Produkt
	$anfrage = "SELECT *
			FROM Exemplar
			WHERE ProduktID = '$produkt_id'";
	$result = mysqli_query($db, $anfrage);
		echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
				style="border-collapse:collapse">        
			<tr>
	            <td align="center" colspan="2">
	                <h3>Verfügbare Exemplare</h3>
	            </td>
	        </tr>';
	    echo '<th>ExemplarID</th>';
		echo '<th>Größe</th>';
		while($row=mysqli_fetch_assoc($result))
		{
			echo '<tr>';
			echo '<td>'.$row['ExemplarID'].'</td>';
			echo '<td>'.$row['Größe'].'</td>';
			#Link zur Ausleihe des konkreten Exemplars per Übergabe der ExemplarID
			echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=lend_time&exemplar_id='.$row['ExemplarID'].'"'.'>Ausleihen</a></td>';
		}

}
?>
</table>