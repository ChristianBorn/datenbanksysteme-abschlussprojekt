<!-- Funktion zur Anzeige von Themen -->
<?php
include ("auth_admin.php");
#Abfrage der eingetragenen Themen
$anfrage = "SELECT *
			from Thema";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Falls keine Themen vorhanden -> Fehlermeldung
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
                <h3>Alle Themen</h3>
            </td>
        </tr>';
	echo '<th>Bezeichnung</th>';
	echo '<th>Beschreibung</th>';
	while($row=mysqli_fetch_assoc($result))
	{
		echo '<tr>';
		echo '<td>'.$row['Bezeichnung'].'</td>';
		echo '<td>'.nl2br($row['Beschreibung']) .'</td>';
		#Link zum Ändern der Themendaten
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=update_theme&bezeichnung='.$row['Bezeichnung'].'"'.'>Bearbeiten</a></td>';
	}
}
?>
</table>