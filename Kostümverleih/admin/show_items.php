<!-- Funktion zur Anzeige von Produktexemplaren -->
<?php
include ("auth_admin.php");
#Abfrage von Exemplaren und Produktdaten
$anfrage = "SELECT ExemplarID, Größe, Bezeichnung
			FROM Exemplar
			INNER JOIN Produkt
			ON Exemplar.ProduktID=Produkt.ProduktID";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
echo mysqli_error($db);
#Falls keine Exemplare vorhanden -> Fehlermeldung
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
                <h3>Alle Exemplare</h3>
            </td>
        </tr>';
	echo '<th>ExemplarID</th>';
	echo '<th>Größe</th>';
	echo '<th>Gehört zu Produkt</th>';
	while($row=mysqli_fetch_assoc($result))
	{
		echo '<tr>';
		echo '<td>'.$row['ExemplarID'].'</td>';
		echo '<td>'.$row['Größe'].'</td>';
		echo '<td>'.$row['Bezeichnung'] .'</td>';
		#Link zur Bearbeitung eines Exemplars
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=update_item&id='.$row['ExemplarID'].'"'.'>Bearbeiten oder Löschen</a></td>';

	}
}
?>
</table>