<!-- Funktion zur Produktsuche über Anlässe -->
<?php include ("auth.php"); ?>
<!-- Formular zur Sucheingabe -->
<form action="index.php?content=search_occasion" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Produktsuche nach Anlass</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Gehört zu Anlass:
            </td>
            <td>
                <select name="anlass" size="5">
                    <?php
                        #Abfrage und Anzeige der verfügbaren Anlässe
                        $anfrage = "SELECT Bezeichnung
                                    FROM Anlass";
                        $result = mysqli_query($db, $anfrage);
                        echo "<option disabled selected>Wählen Sie einen Anlass</option>";
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option>".$row['Bezeichnung']."</option>";
                        }
                    ?>
                </select>
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Suche mit ausgewählten Kriterien" name="submit">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    
    $anlass = strip_tags(trim($_POST['anlass']));
    #Falls Eingabe leer -> Fehlermeldung
    if (empty($anlass)) 
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie einen Suchbegriff ein</font></td></tr>";
    }
    else
    {
        #Abfrage über Produkt, Produkt_Anlass und Bewertung, gleichzeitig wird die Durchschnittspunktzahl errechnet und danach sortiert
        $anfrage="SELECT Produkt.ProduktID, Produkt.Bezeichnung AS Produkt_Bezeichnung, Beschreibung, 
                            Mietpreis, Lieferumfang, Geschlecht, Art, AVG(Punkte) AS Durchschnitt
                    FROM (
                        Produkt
                    LEFT JOIN 
                        Produkt_Anlass
                    ON 
                        Produkt.ProduktID = Produkt_Anlass.ProduktID
                         )
                    INNER JOIN
                        Bewertung
                    ON
                        Produkt.ProduktID = Bewertung.ProduktID
                    WHERE 
                        Produkt_Anlass.Bezeichnung = '$anlass'
                    GROUP BY
                        Produkt.ProduktID
                    ORDER BY
                        Durchschnitt DESC";
        $result = mysqli_query($db, $anfrage);
        $num = mysqli_num_rows($result);
        #Falls Ergebnis leer -> Fehlermeldung
        if ($num == 0) 
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
            Keine Datensätze gefunden!</font></td></tr>";
        }
        else 
        {
            echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
                    style="border-collapse:collapse">        
                <tr>
                    <td align="center" colspan="2">
                        <h3>Gefundene Produkte</h3>
                    </td>
                </tr>';
            echo '<th>Bild</th>';
            echo '<th>Bezeichnung</th>';
            echo '<th>Beschreibung</th>';
            echo '<th>Mietpreis</th>';
            echo '<th>Lieferumfang</th>';
            echo '<th>Geschlecht</th>';
            echo '<th>Art</th>';
            echo '<th>Durchschnittliche Bewertung</th>';
            while($row=mysqli_fetch_assoc($result))
            {
                echo '<tr>';
                echo '<td><img src="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/admin/show_images.php?id='.$row['ProduktID'].'"'.'height="200px" width="200px"></td>';        
                echo '<td>'.$row['Produkt_Bezeichnung'].'</td>';
                echo '<td>'.nl2br($row['Beschreibung']).'</td>';
                echo '<td>'.$row['Mietpreis'].'</td>';
                echo '<td>'.nl2br($row['Lieferumfang']) .'</td>';
                echo '<td>'.$row['Geschlecht'].'</td>';
                echo '<td>'.$row['Art'] .'</td>';
                echo '<td>'.$row['Durchschnitt'] .'</td>';
                #Link zur Ausleihe des angezeigten Produkts
                echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=lend_time&produkt_id='.$row['ProduktID'].'"'.'>Ausleihen</a></td>';
                #Link zu weiteren Bildern des angezeigten Produkts
                echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=similar_products&product_id='.$row['ProduktID'].'"'.'>Passende Kostüme und Accessoires</a></td>';

            }
        }
        mysqli_close($db);
}

}

?>

    </table>