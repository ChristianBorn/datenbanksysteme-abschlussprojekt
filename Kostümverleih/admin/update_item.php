<!-- Funktion zum Ändern von Exemplardaten -->
<?php 
include ("auth_admin.php");
$id=(int)$_GET['id'];
#Abfrage der Daten des gewählten Exemplars
$anfrage = "SELECT *
            FROM Exemplar
            WHERE ExemplarID='".$id."'";
$result = mysqli_query($db, $anfrage);
$row=mysqli_fetch_assoc($result);

?>
<form action="index.php?content=update_item&id=<?php echo $id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Exemplardaten ändern</h3>
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
                        $anfrage = "SELECT ProduktID, Bezeichnung
                                    from Produkt";
                        $result = mysqli_query($db, $anfrage);
                        while($row=mysqli_fetch_assoc($result))
                        {
                            #ID und Bezeichnung werden zusammengesetzt, um dem User die Eingabe zu erleichtern
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
        <tr>
            <td align="center" colspan="3">
                <input type="submit" value="Löschen" name="delete">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    $groesse=$_POST['groesse'];
    #ID und Bezeichnung werden wieder auseinandergenommen zur Weiterverarbeitung
    $product_item=intval(preg_replace('/[^0-9]+/', '', $_POST['product_item']));
    $eintrag="UPDATE Exemplar
                SET Größe='$groesse', ProduktID='$product_item'
                WHERE ExemplarID='$id'";

    if (mysqli_query($db, $eintrag)) 
    {
        echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
        header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_items");
        
    }
    else 
    {
        echo "Fehler beim Speichern";
    }
    
    mysqli_close($db);
}
#Falls "Löschen" geklickt wurde
if (isset($_POST["delete"])) 
{
    #gewählten Eintrag löschen
    $eintrag="DELETE FROM Exemplar
                WHERE ExemplarID='$id'";
    if (mysqli_query($db, $eintrag))
        {
            echo "<p align='center'>Eintrag erfolgreich gelöscht<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_items");
        }
        else 
        {
            echo "Fehler beim Löschen";
        }
    mysqli_close($db);
}

?>
    </table>
