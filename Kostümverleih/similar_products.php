<!-- Funktion zur Anzeige passender Produkte -->
<?php include ("auth.php"); 
#Abfrage des gewählten Produkts
$id = $_GET['product_id'];
$anfrage="SELECT *
            FROM 
                Produkt
            INNER JOIN 
                passt_zu
            ON 
                ProduktID = passt_zu.passendesProdukt
            WHERE 
                Produkt = '$id'";
$result = mysqli_query($db, $anfrage);
$num = mysqli_num_rows($result);

#Wenn keine passenden Produkte vorhanden sind -> Fehlermeldung
if ($num == 0) 
{
    echo "<tr><td align='center' colspan='3'><font color='red'>
    Keine Datensätze gefunden!</font></td></tr>";
}
if ($num > 0)
{
    #Tabelle zur Anzeige des Ergebnis
    echo '<table border="1" align="center" bgcolor="#E0E0E0" cellspacing="0" cellpadding="5"
            style="border-collapse:collapse">        
        <tr>
            <td align="center" colspan="2">
                <h3>Passende Produkte</h3>
            </td>
        </tr>';
    echo '<th>Bild</th>';
    echo '<th>Bezeichnung</th>';
    echo '<th>Beschreibung</th>';
    echo '<th>Mietpreis</th>';
    echo '<th>Lieferumfang</th>';
    echo '<th>Geschlecht</th>';
    echo '<th>Art</th>';
    while($row=mysqli_fetch_assoc($result))
    {
        echo '<tr>';
        #Anzeige Bild
        echo '<td><img src="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/admin/show_images.php?id='.$row['ProduktID'].'"'.'height="200px" width="200px"></td>';
        echo '<td>'.$row['Bezeichnung'].'</td>';
        echo '<td>'.nl2br($row['Beschreibung']).'</td>';
        echo '<td>'.$row['Mietpreis'].'</td>';
        echo '<td>'.nl2br($row['Lieferumfang']) .'</td>';
        echo '<td>'.$row['Geschlecht'].'</td>';
        echo '<td>'.$row['Art'] .'</td>';
        #Zur Ausleihe des angezeigten Produkts
        echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=lend_time&produkt_id='.$row['ProduktID'].'"'.'>Ausleihen</a></td>';
        #Anzeige ähnlicher Produkte
        echo '<td><a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/index.php?content=similar_products&product_id='.$row['ProduktID'].'"'.'>Passende Kostüme und Accessoires</a></td>';
    }
    mysqli_close($db);
}
    


?>

    </table>