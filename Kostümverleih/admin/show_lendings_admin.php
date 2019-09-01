<!-- Funktion zur Anzeige von allen Ausleihen im Mitarbeiterbereich -->
<?php
include ("auth_admin.php");
#Abfrage von Ausleihen und Produktdaten
$anfrage = "SELECT KundenNr, Bezeichnung, Größe, Startdatum, Enddatum, Produkt.ProduktID
            FROM(
             Ausleihe
             INNER JOIN
             Exemplar
             ON
             Ausleihe.ExemplarID=Exemplar.ExemplarID
             )
            INNER JOIN
            Produkt
            ON
            Exemplar.ProduktID=Produkt.ProduktID";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);
#Falls keine Ausleihen vorhanden -> Fehlermeldung
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
                <h3>Alle Ausleihen</h3>
            </td>
        </tr>';
    echo '<th>KundenNr</th>';
    echo '<th>Produkt</th>';
    echo '<th>Größe</th>';
    echo '<th>Startdatum</th>';
    echo '<th>Enddatum</th>';
    while($row=mysqli_fetch_assoc($result))
    {
        echo '<tr>';
        echo '<td>'.$row['KundenNr'].'</td>';
        echo '<td>'.$row['Bezeichnung'].'</td>';
        echo '<td>'.$row['Größe'].'</td>';
        echo '<td>'.$row['Startdatum'].'</td>';
        echo '<td>'.$row['Enddatum'].'</td>';
    }
}
?>
</table>