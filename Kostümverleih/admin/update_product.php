<!-- Funktion zur Änderung von Produktdaten -->
<?php 
include ("auth_admin.php");
$id=(int)$_GET['id'];
#Abfrage der Produktdaten des gewählten Produkts
$anfrage = "SELECT *
            FROM Produkt
            WHERE ProduktID='".$id."'";
$result = mysqli_query($db, $anfrage);
$row=mysqli_fetch_assoc($result);

?>
<form action="index.php?content=update_product&id=<?php echo $id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Produktdaten ändern</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Bezeichnung:
            </td>
            <td>
                <input type="text" name="bezeichnung" size="30" value="<?php echo $row['Bezeichnung']; ?>">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Beschreibung:
            </td>
            <td>
                <textarea cols="50" rows="10" name="beschreibung"><?php echo $row['Beschreibung']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Mietpreis pro Tag:
            <td>
                <input type="text" name="mietpreis" value="<?php echo $row['Mietpreis']; ?>"> €
            </td>
        </tr>
        <tr>
            <td align="right">
                Lieferumfang:
            </td>
            <td>
                <textarea name="lieferumfang" cols="50" rows="10"><?php echo $row['Lieferumfang']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Geschlecht:
                <td><input type="radio" name="geschlecht" value="Mann">
                Männlich
                <input type="radio" name="geschlecht" value="Frau">
                Weiblich
                <input type="radio" name="geschlecht" value="Neutral">
                geschlechtsneutral</td>
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        <tr>
            <td align="right">
                Art:
                <td><input type="radio" name="art" value="Kostüm">
                Kostüm
                <input type="radio" name="art" value="Accessoire">
                Accessoire</td>
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Daten ändern" name="submit">
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <input type="submit" value="Eintrag löschen" name="delete">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{

    $bezeichnung=strip_tags(trim($_POST['bezeichnung']));
    $beschreibung=strip_tags(trim($_POST['beschreibung']));
    $mietpreis=strip_tags(trim($_POST['mietpreis']));
    $lieferumfang=strip_tags(trim($_POST['lieferumfang']));
    $geschlecht=$_POST['geschlecht'];
    $art=$_POST['art'];
    #Überprüfen der Pflichtfelder
    if (empty($bezeichnung) or empty($art) or empty($geschlecht))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte füllen Sie die Pflichtfelder aus</font></td></tr>";
    }
    #Überprüfen der Gültigkeit der Preiseingabe
    elseif (!is_numeric($mietpreis) or number_format($mietpreis, 2, ",", "") < 0 )
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie eine gültige Zahl als Mietpreis an</font></td></tr>";
    }
    else 
    {  
        #Falls alles valide ist, Änderung in die Datenbank
        $eintrag="UPDATE Produkt
                    SET Bezeichnung='$bezeichnung', Beschreibung='$beschreibung', Mietpreis='$mietpreis', Lieferumfang='$lieferumfang', Geschlecht='$geschlecht', Art='$art'
                    WHERE ProduktID='$id'";
        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_products");
            break;
        }
        else 
        {
            echo "Fehler beim Speichern";
        }
    }
    mysqli_close($db);
}
#Falls Löschen geklickt wurde
if (isset($_POST["delete"])) 
{
    #Löschen des Eintrags
    $eintrag="DELETE FROM Produkt
                WHERE ProduktID='$id'";
    if (mysqli_query($db, $eintrag))
        {
            echo "<p align='center'>Eintrag erfolgreich gelöscht<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_products");
        }
        else 
        {
            echo mysql_error($db);
        }
    mysqli_close($db);
}

?>

    </table>