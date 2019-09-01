<!-- Funktion zum Anzeigen der Bewertungen des aktuellen Nutzers -->
<?php
include ("auth_admin.php");
#Abfragen des aktuellen Nutzers
session_start();
$user=$_SESSION["user_id"];
#Abfrage der Produktdaten des bewerteten Produkts
$anfrage = "SELECT Bezeichnung, Punkte, Kommentar
            FROM
                Produkt
            INNER JOIN
                Bewertung
            ON
                Produkt.ProduktID = Bewertung.ProduktID
            Where KundenNr = $user";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Wenn Suchergebnis leer -> Fehlermeldung
if ($num == 0) 
{
    echo "<p align='center'>Sie haben noch keine Produkte bewertet!</p>";
}
else 
{
    #Tabelle zur Anzeige der Bewertungen mit der Bezeichnung des bewerteten Produkts
    echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
            style="border-collapse:collapse">        
        <tr>
            <td align="center" colspan="2">
                <h3>Meine Bewertungen</h3>
            </td>
        </tr>';
    echo '<th>Produkt</th>';
    echo '<th>Vergebene Punktzahl</th>';
    echo '<th>Kommentar</th>';
    while($row=mysqli_fetch_assoc($result))
    {
        echo '<tr>';
        echo '<td>'.$row['Bezeichnung'].'</td>';
        echo '<td>'.$row['Punkte'].'</td>';
        echo '<td>'.$row['Kommentar'].'</td>';

    }
}
?>
</table>