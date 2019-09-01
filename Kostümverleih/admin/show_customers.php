<!-- Funktion zur Anzeige aller Kunden -->
<?php
include ("auth_admin.php");
#Abfragen der Kunden
$anfrage = "SELECT *
			from Kunde";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Falls keine Kunden vorhanden -> Fehlermeldung
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
                <h3>Alle Kunden</h3>
            </td>
        </tr>';
	echo '<th>KundenNr.</th>';
	echo '<th>Vorname</th>';
	echo '<th>Nachname</th>';
	echo '<th>Geschlecht</th>';
	echo '<th>Email</th>';
	echo '<th>Passwort</th>';
	while($row=mysqli_fetch_assoc($result))
	{
		echo '<tr>';
		echo '<td>'.$row['KundenNr'].'</td>';
		echo '<td>'.$row['Vorname'].'</td>';
		echo '<td>'.$row['Nachname'] .'</td>';
		echo '<td>'.$row['Geschlecht'].'</td>';
		echo '<td>'.$row['Email'] .'</td>';
		echo '<td>'.$row['Passwort'] .'</td>';
	}
}
?>
</table>