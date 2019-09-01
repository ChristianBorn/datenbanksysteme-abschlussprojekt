<!-- Funktion zur Ausleihe eines konkreten Exemplars nach Prüfung, welche verfügbar sind -->
<?php include ("auth.php");
#Speichern des gewählten Produkts und des gewählten Zeitraums in eine Session
session_start();
$produkt_id=$_SESSION["produkt_id"];
$start=$_SESSION["start"];
$ende=$_SESSION["ende"];
#Falls noch kein Exemplar gewählt wurde, verfügbare Exemplare anzeigen
if (is_null($_GET["exemplar_id"]))
{
    #Anfrage, ob Exemplare für den gewählten Zeitraum zur Verfügung stehen
    $anfrage = "SELECT *
            FROM Exemplar
            WHERE ProduktID = '$produkt_id' AND NOT EXISTS
                    (SELECT * FROM Ausleihe WHERE 
                        (DATEDIFF (Enddatum, '$start') > 0 AND DATEDIFF(Startdatum, '$ende') < 0) #Bedingung, dass Exemplare für den gewählten Zeitraum verfügbar sind
                        AND                                                                       #den gewählten Zeitraum verfügbar sind
                        Exemplar.ExemplarID=Ausleihe.ExemplarID)";
    $result = mysqli_query($db, $anfrage);
    $num = mysqli_num_rows($result);
    #Falls Ergebnis nicht leer, also Exemplare verfügbar sind
    if ($num > 0)
    {
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
            #Link zur Ausleihe des Exemplars
            echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=lend_item&exemplar_id='.$row['ExemplarID'].'"'.'>Ausleihen</a></td>';
        }
    }
    else 
    {
            echo '<tr><td><p algin="center">Keine verfügbaren Exemplare für den gewählten Zeitraum</p></td></tr>';
            echo '</table>';
 
    }
    }
#wenn der Link "Ausleihe" geklickt wird, wird die exemplar_id übergeben
if (!is_null($_GET["exemplar_id"]))
{
    #Session zur Ermittlung des Users und der Exemplar ID
    session_start();
    $user_id=$_SESSION["user_id"];
    $exemplar_id=$_GET["exemplar_id"];
        #Das vom Kunden gewählte Exemplar wird in Ausleihe eingetragen
        $eintrag="INSERT INTO Ausleihe
                    (ExemplarID, KundenNr, Startdatum, Enddatum)
                    VALUES
                    ('$exemplar_id', '$user_id', '$start', '$ende')";

        if (mysqli_query($db, $eintrag)) 
        {
            #Der gerade gemachte Eintrag in Ausleihe wird wieder abgerufen und mit anderen Ausleihen angezeigt
            $anfrage = "SELECT Bezeichnung, Größe, Startdatum, Enddatum, Produkt.ProduktID, Mietpreis, Mietpreis*(DATEDIFF(Enddatum,Startdatum)+2) AS Gesamtpreis
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
            WHERE KundenNr = $user_id";
            $result = mysqli_query($db, $anfrage);

            echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
                    style="border-collapse:collapse">        
                <tr>
                    <td align="center" colspan="2">
                        <h3>Ihre Ausleihdaten</h3>
                    </td>
                </tr>';
            echo '<th>Bezeichnung</th>';
            echo '<th>Größe</th>';
            echo '<th>Startdatum</th>';
            echo '<th>Enddatum</th>';
            echo '<th>Mietpreis</th>';
            echo '<th>Gesamtpreis</th>';
            while($row=mysqli_fetch_assoc($result))
            {
                echo '<tr>';
                echo '<td>'.$row['Bezeichnung'].'</td>';
                echo '<td>'.$row['Größe'].'</td>';
                echo '<td>'.$row['Startdatum'].'</td>';
                echo '<td>'.$row['Enddatum'].'</td>';
                echo '<td>'.$row['Mietpreis'].'</td>';
                echo '<td>'.$row['Gesamtpreis'].'</td>';
            }
        }
        echo mysqli_error($db);
        #zurücksetzen der Session Variablen
        $_SESSION["produkt_id"]=Null;
        $_SESSION["start"]=Null;
        $_SESSION["ende"]=Null;
        mysqli_close($db);

}

?>

    </table>