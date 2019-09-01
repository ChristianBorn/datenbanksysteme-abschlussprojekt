<!-- Funktion zum Hinzufügen eines neuen Produktexemplars -->
<?php include ("auth_admin.php"); ?>
<form action="index.php?content=add_item" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Produktexemplar hinzuf&uuml;gen</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Größe:
            </td>
            <td>
                <select name="groesse" size="1">
                    <option>XS</option>
                    <option>S</option>
                    <option>M</option>
                    <option>L</option>
                    <option>XL</option>
                    <option>Einheitsgröße</option>
                </select>
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Gehört zu Produkt:
            </td>
            <td>
                <select name="product_item" size="1">
                    <?php
                        #Anzeige von vorhandenen Produkten zur Zuordnung des Exemplars
                        $anfrage = "SELECT ProduktID, Bezeichnung
                                    from Produkt";
                        $result = mysqli_query($db, $anfrage);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option>".$row['ProduktID']."."." ".$row['Bezeichnung']."</option>";
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
                <input type="submit" value="Hinzuf&uuml;gen" name="submit">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    $groesse=$_POST['groesse'];
    #ProduktID wird herausgefiltert
    $product_item=intval(preg_replace('/[^0-9]+/', '', $_POST['product_item']));
    
    $eintrag="INSERT INTO Exemplar
                (Größe, ProduktID)
                VALUES
                ('$groesse', '$product_item')";

    if (mysqli_query($db, $eintrag)) 
    {
        echo "<p align='center'>Eintrag erfolgreich</p>";
        header ("Refresh: 2; URL=http://www.dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_items");
    }
    else 
    {
        echo "Fehler beim Speichern";
    }
    
    mysqli_close($db);
}

?>

    </table>