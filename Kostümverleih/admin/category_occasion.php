<!-- Funktion zur Zuordnung von Anlässen zum gewählten Produkt -->
<?php include ("auth_admin.php"); 
$id=$_GET["id"];?>
<form action="index.php?content=category_occasion&id=<?php echo $id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Anlässe zum Produkt hinzufügen</h3>
                Es werden nur noch nicht vergebene Anlässe angezeigt
            </td>
        </tr>
            <td align="right">
                Gehört zu Anlass:
            </td>
            <td>
                <select multiple="multiple" name="anlass_produkt[]" size="5">
                    <?php
                        #Anzeigen der vorhandenen und noch nicht für dieses Produkt vergebenen Anlässe
                        $anfrage = "SELECT Bezeichnung
                                    FROM Anlass
                                    WHERE Bezeichnung NOT IN (
                                        SELECT Bezeichnung FROM Produkt_Anlass WHERE ProduktID = '$id')";
                        $result = mysqli_query($db, $anfrage);
                        $num = mysqli_num_rows($result);
                        
                        echo "<option disabled selected>Wählen Sie ein oder mehrere Anlässe mit strg</option>";
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option>".$row['Bezeichnung']."</option>";
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
    $anlass_produkt=$_POST['anlass_produkt'];
    $number_anlass=count($anlass_produkt);
    $counter_anlass=0;
    #Falls mindestens ein Anlass gewählt wurde
    if ($number_anlass != 0)
    {
        #Durchlaufen der Eingabe
        foreach ($anlass_produkt as $var) 
        {
            #Eintragen in die Datenbank
            $eintrag="INSERT INTO Produkt_Anlass
                        VALUES ('$id', '$var')";
            if (mysqli_query($db,$eintrag))
            {
                $counter_anlass=$counter_anlass+1;
            }
        }
        #Kontrolle, ob Eintrag korrekt
        if ($number_anlass == $counter_anlass)
        {
            echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_products");
        }
    }
        else
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie mindestens einen Anlass an</font></td></tr>";
        }

        mysqli_close($db);

}
?>

    </table>