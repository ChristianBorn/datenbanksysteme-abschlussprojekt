<!-- Funktion zur Änderung von Anlassdaten -->
<?php 
include ("auth_admin.php");
$bezeichnung=$_GET['bezeichnung'];
#Abfrage der Daten des gewählten Anlasses
$anfrage = "SELECT *
            FROM Anlass
            WHERE Bezeichnung='".$bezeichnung."'";
$result = mysqli_query($db, $anfrage);
$row=mysqli_fetch_assoc($result);

?>
<form action="index.php?content=update_occasion&bezeichnung=<?php echo $bezeichnung; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Anlass ändern</h3>
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
                <textarea name="beschreibung" cols="50" rows="10"><?php echo $row['Beschreibung']; ?></textarea>
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
                <input type="submit" value="Eintrag Löschen" name="delete">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{

    $bezeichnung=strip_tags(trim($_POST['bezeichnung']));
    $beschreibung=strip_tags(trim($_POST['beschreibung']));
    #Überprüfung der Pflichtfelder
    if (empty($bezeichnung))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte füllen Sie die Pflichtfelder aus</font></td></tr>";
    }
    else 
    {  
        #Eintrag in die Datenbank
        $eintrag="UPDATE Anlass
                    SET Bezeichnung='".$bezeichnung."', Beschreibung='".$beschreibung."'
                    WHERE  Bezeichnung='".$bezeichnung."'";

        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_occasions");

        }
        else 
        {
            echo "Fehler beim Speichern";
        }
    }
    mysqli_close($db);
}
#Falls "Löschen" geklickt wurde
if (isset($_POST["delete"])) 
{
    #gewählten Eintrag löschen
    $eintrag="DELETE FROM Anlass
                WHERE Bezeichnung='".$bezeichnung."'";
    
    if (mysqli_query($db, $eintrag))
        {
            echo "<p align='center'>Eintrag erfolgreich gelöscht<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_occasions");
        }
        else 
        {
            echo "Fehler beim Löschen";
        }
    mysqli_close($db);
}
?>

    </table>