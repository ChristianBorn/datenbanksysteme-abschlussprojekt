<!-- Funktion zur Anzeige der vom User getätigten Ausleihen -->
<?php
include ("auth.php");
#Auslesen des aktuellen Users
session_start();
$user=$_SESSION["user_id"];
#Abfrage der Daten des ausgeliehenen Produkts Join über Tabellen Ausleihe, Exemplar und Produkt
$anfrage = "SELECT Bezeichnung, Größe, Startdatum, Enddatum, Produkt.ProduktID
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
            Exemplar.ProduktID=Produkt.ProduktID
            WHERE KundenNr='$user'";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);

#Falls Ergebnis leer -> Fehlermeldung
if ($num == 0) 
{
    echo "<p align='center'>Sie haben noch keine Produkte ausgeliehen!</p>";
}
else 
{
    #Tabelle zum Anzeigen der Daten der getätigten Ausleihen
    echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
            style="border-collapse:collapse">        
        <tr>
            <td align="center" colspan="2">
                <h3>Meine Ausleihen</h3>
            </td>
        </tr>';
    echo '<th>Produkt</th>';
    echo '<th>Größe</th>';
    echo '<th>Startdatum</th>';
    echo '<th>Enddatum</th>';
    while($row=mysqli_fetch_assoc($result))
    {
        echo '<tr>';
        echo '<td>'.$row['Bezeichnung'].'</td>';
        echo '<td>'.$row['Größe'].'</td>';
        echo '<td>'.$row['Startdatum'].'</td>';
        echo '<td>'.$row['Enddatum'].'</td>';
        #Link zur Bewertung
        echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=add_rating&produkt_id='.$row['ProduktID'].'"'.'>Bewerten</a></td>';

    }
}
?>
</table>