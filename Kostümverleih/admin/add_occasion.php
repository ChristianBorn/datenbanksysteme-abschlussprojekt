<!-- Funktion zum Hinzufügen eines neuen Anlasses -->
<?php include ("auth_admin.php"); ?>
<form action="index.php?content=add_occasion" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Anlass hinzuf&uuml;gen</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Bezeichnung:
            </td>
            <td>
                <input type="text" name="bezeichnung" size="30">
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
                <textarea name="beschreibung" <textarea cols="50" rows="10"></textarea>
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
    #Kontrolle, ob Pflichtfeld nicht leer
    if (empty($bezeichnung))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte füllen Sie die Pflichtfelder aus</font></td></tr>";
    }
    else
    {
        #Eintrag in Datenbank
        $eintrag="INSERT INTO Anlass
                    (Bezeichnung, Beschreibung)
                    VALUES
                    ('$bezeichnung', '$beschreibung')";

        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align=center>Eintrag erfolgreich</p>";
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