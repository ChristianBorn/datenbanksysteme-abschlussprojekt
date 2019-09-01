<!-- Funktion zur Produktsuche über Preisspanne -->
<?php include ("auth.php"); ?>
<!-- Formular zur Sucheingabe -->
<form action="index.php?content=search_price" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Produktsuche nach Preisspanne</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Mietpreis: 
                Von
            <td>
                <input type="text" name="von" value="0.0"> €
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>                
            <td>
                Bis
                <input type="text" name="bis" value="0.0"> €
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
    
    $von = strip_tags(trim($_POST['von']));
    $bis = strip_tags(trim($_POST['bis']));
    #überprüfung der Eingabe für die Preisspanne, ob die Eingabe nur aus Zahlen besteht und ob die Spanne gültig ist
    if (!is_numeric($von) or !is_numeric($bis) or number_format($bis, 2, ",", "") < number_format($von, 2, ",", ""))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie eine gültige Preisspanne ein</font></td></tr>";
    }
    #Falls Eingabe leer oder ungültig -> Fehlermeldung
    elseif (!empty($von) and !empty($bis) or $von == 0) 
    {
    #Abfrage über Produkt und Bewertung, gleichzeitig wird die Durchschnittspunktzahl errechnet und danach sortiert   
    $anfrage="SELECT Produkt.ProduktID, Produkt.Bezeichnung AS Produkt_Bezeichnung, Beschreibung, 
                        Mietpreis, Lieferumfang, Geschlecht, Art, AVG(Punkte) AS Durchschnitt
                FROM Produkt
                LEFT JOIN
                    Bewertung
                ON
                    Produkt.ProduktID = Bewertung.ProduktID
                WHERE
                    Mietpreis BETWEEN '$von' AND '$bis'
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
else
    {
    echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie eine Preisspanne ein</font></td></tr>";
    }
}

?>

    </table>