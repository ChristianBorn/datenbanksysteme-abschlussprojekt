<!-- Funktion zur Anzeige von Anlässen -->
<?php
include ("auth_admin.php");
#Abfrage der eingetragenen Anlässe
$anfrage = "SELECT *
			from Anlass";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Falls keine Anlässe vorhanden -> Fehlermeldung
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
                <h3>Alle Anlässe</h3>
            </td>
        </tr>';
	echo '<th>Bezeichnung</th>';
	echo '<th>Beschreibung</th>';
	while($row=mysqli_fetch_assoc($result))
	{
		echo '<tr>';
		echo '<td>'.$row['Bezeichnung'].'</td>';
		echo '<td>'.nl2br($row['Beschreibung']) .'</td>';
		##Link zur Bearbeitung des Anlasses
		echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=update_occasion&bezeichnung='.$row['Bezeichnung'].'"'.'>Bearbeiten</a></td>';
	}
}
mysqli_close($db);
?>
</table>