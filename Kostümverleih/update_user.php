<!-- Funktion Zum Ändern der Kundendaten des aktuell eingeloggten Kunden -->
<?php 
include ("auth.php");
#Auslesen der KundeNr des angemeldeten Kunden über die Session
session_start();
$user_id=$_SESSION["user_id"];
#Array für die korrekte Anzeige des Select Felds für die Auswahl des Geschlechts
$geschlecht_auswahl = array("männlich","weiblich");
#Abrage der Kundendaten des aktuellen Users
$anfrage = "SELECT *
            FROM Kunde
            WHERE KundenNr='$user_id'";
$result = mysqli_query($db, $anfrage);
$row = mysqli_fetch_assoc($result);

#Block filtert das aktuelle Geschlecht des Kunden und zeigt nur das nicht ausgewählte Geschlecht als wählbar an
$geschlecht_auswahl = array_diff($geschlecht_auswahl, array($row["Geschlecht"]));
if (empty($geschlecht_auswahl[1]))
{
    $geschlecht_auswahl = array_diff(array("weiblich", "männlich"), array($row["Geschlecht"]));
}

?>
<!-- Formular zu Angabe der Daten -->
<form action="index.php?content=update_user&user_id=<?php echo $user_id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Konto Bearbeiten</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorname:
            </td>
            <td>
                <input type="text" name="vorname" size="30" value="<?php echo $row['Vorname']; ?>">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Nachname:
            </td>
            <td>
                <input type="text" name="nachname" size="30" value="<?php echo $row['Nachname']; ?>">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                    Geschlecht:
            </td>
            <td>
                <select name="geschlecht" size="2">
                    <?php
                        echo "<option selected>".$row['Geschlecht']."</option>";
                        echo "<option>".$geschlecht_auswahl[1]."</option>";
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right">
                Email Adresse:
            </td>
            <td>
                <input type="text" name="email" size="30" value="<?php echo $row['Email']; ?>">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Altes Passwort: 
            </td>
            <td>
                <input name="passwort_alt" type="text" disabled value="<?php echo $row['Passwort']; ?>">
            </td>
        </tr>
        <tr>
            <td align="right">
                Neues Passwort: 
            </td>
            <td>
                <input name="passwort" type="password"><br>
            </td>
        </tr>
        <tr>
            <td align="right">
                Neues Passwort noch einmal: 
            </td>
            <td>
                <input name="passwort2" type="password"><br>
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
                <input type="submit" value="Passwort ändern" name="change_password">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    $vorname=strip_tags(trim($_POST['vorname']));
    $nachname=strip_tags(trim($_POST['nachname']));
    $geschlecht=strip_tags(trim($_POST['geschlecht']));
    $email=strip_tags(trim($_POST['email']));
    #Überprüfen, ob Pflichtfelder leer sind
    if (empty($vorname) or empty($nachname) or empty($email))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte füllen Sie die Pflichtfelder aus</font></td></tr>";
    }
    #Überprüfen der Email Adresse auf Gültigkeit
    elseif (!preg_match("/^[0-9a-zäüöÄÜÖ]+[_\.0-9a-z\-äüöÄÜÖ]*\@([0-9a-zäüöÄÜÖ]+[0-9a-z\-_äüöÄÜÖ]*\.){1,5}(de|com|net|org){1}$/i", $email))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
            Geben Sie eine gültige Email Adresse ein</font></td></tr>";
    }
    else 
    {  
        #Eintragen der eingegeben Daten nach Validierung
        $eintrag="UPDATE Kunde
                    SET Vorname='$vorname', Nachname='$nachname', Geschlecht='$geschlecht', Email='$email'
                    WHERE  KundenNr='$user_id'";

        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align='center'>Ihre Daten wurden erfolgreich geändert</p>";
            location.reload();
        }
        else 
        {
            echo "Fehler beim Speichern";
        }
        mysqli_close($db);
    }
}
#Funktion zur Änderung des Passworts
if (isset($_POST["change_password"]))
{
    $passwort=strip_tags(trim($_POST['passwort']));
    $passwort2=strip_tags(trim($_POST['passwort2']));
    #Abfrage, ob Felder gefüllt sind
    if (empty($passwort) or empty($passwort2))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte füllen Sie die Passwortfelder aus</font></td></tr>";
    }
    else
    {
        #Abfrage, ob das Kontrollfeld gleich der ersten Passworteingabe ist
        #Wenn ja, Eintrag in die Datenbank
        if ($passwort == $passwort2)
        {
            $eintrag="UPDATE Kunde
                        SET Passwort='$passwort'
                        WHERE  KundenNr='$user_id'";

            if (mysqli_query($db, $eintrag)) 
            {
                echo "<p align='center'>Passwort erfolgreich geändert</p>";
            }
            else 
            {
                echo "Fehler beim Speichern";
            }
            mysqli_close($db);            
        }
        else
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
            Passwörter stimmen nicht überein!</font></td></tr>";
        }
    }
}

?>

    </table>