<!-- Funktion zur Zuordnung von zueinander passenden Produkten -->
<?php include ("auth_admin.php"); 
$id=$_GET["id"];?>
<form action="index.php?content=category_product&id=<?php echo $id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Passende Produkte zum Produkt hinzufügen</h3>
                Es werden nur noch nicht dem gewählten Produkt zugeordnete Produkte angezeigt
            </td>
        </tr>
            <td align="right">
                Passt zu Produkt:
            </td>
            <td>
                <select multiple="multiple" name="produkt_produkt[]" size="5">
                    <?php
                        #Anzeige der noch nicht zu diesem Produkt zugeordneten Produkte
                        $anfrage = "SELECT ProduktID, Bezeichnung
                                    FROM Produkt
                                    WHERE ProduktID != '$id' AND ProduktID NOT IN (
                                        SELECT passendesProdukt FROM passt_zu WHERE Produkt = '$id')";
                        $result = mysqli_query($db, $anfrage);
                        $num = mysqli_num_rows($result);
                        
                        echo "<option disabled selected>Wählen Sie ein oder mehrere Produkte mit strg</option>";
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option>".$row['ProduktID']."."." ".$row['Bezeichnung']."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Hinzuf&uuml;gen" name="submit">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    $produkt_produkt=$_POST['produkt_produkt'];
    $number_produkt=count($produkt_produkt);
    $counter_produkt=0;
    #Falls ein Produkt ausgewählt wurde
    if ($number_produkt != 0)
    {
        #Durchlaufen der Eingabe
        foreach ($produkt_produkt as $var)
        {
            #Filterung der ID aus der Eingabe
            $var = intval(preg_replace('/[^0-9]+/', '', $var));
            #Eintrag in Datenbank
            $eintrag="INSERT INTO passt_zu
                        VALUES ('$id', '$var')";
            if (mysqli_query($db,$eintrag))
            {
                $counter_produkt=$counter_produkt+1;
            }
        }
        #Überprüfung, ob alle gewählten Eingaben eingetragen wurden
        if ($number_produkt == $counter_produkt)
        {
            echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_products");
        }
    }
        else
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie mindestens ein passendes Produkt an</font></td></tr>";
        }

        mysqli_close($db);

}
?>

    </table>