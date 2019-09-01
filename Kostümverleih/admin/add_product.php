<!-- Funktion zum Hinzufügen eines neuen Produkts -->
<?php include ("auth_admin.php"); ?>
<form action="index.php?content=add_product" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Produkt hinzuf&uuml;gen</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Bezeichnung:
            </td>
            <td>
                <input type="text" name="bezeichnung" size="30" value="">
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
                <textarea cols="50" rows="10" name="beschreibung"></textarea>
            </td>
        </tr>
        <tr>
            <td align="right">
                Mietpreis pro Tag:
            <td>
                <input type="text" name="mietpreis" value="0.0"> €
            </td>
        </tr>
        <tr>
            <td align="right">
                Lieferumfang:
            </td>
            <td>
                <textarea cols="50" rows="10" name="lieferumfang"></textarea>
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
        </tr>
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
                <input type="submit" value="Hinzuf&uuml;gen" name="submit">
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

    #Kontrolle der Pflichtfelder
    if (empty($bezeichnung) or empty($geschlecht) or empty($art))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte füllen Sie die Pflichtfelder aus</font></td></tr>";
    }
    #Kontrolle des eingebenen Mietpreises, ob es einen gültige Zahl ist
    elseif (!is_numeric($mietpreis) or number_format($mietpreis, 2, ",", "") < 0 )
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie eine gültige Zahl als Mietpreis an</font></td></tr>";
    }
    else 
    {   
        #Falls alles valide, Eintrag in die Datenbank
        $eintrag="INSERT INTO Produkt
                    (Bezeichnung, Beschreibung, Mietpreis, Lieferumfang, Geschlecht, Art)
                    VALUES
                    ('$bezeichnung', '$beschreibung', '$mietpreis',
                        '$lieferumfang', '$geschlecht', '$art')";
        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align='center'>Eintrag erfolgreich</p>";
        }
        else 
        {
            echo "Fehler beim Speichern";
        }
    }

    mysqli_close($db);
}

?>

    </table>