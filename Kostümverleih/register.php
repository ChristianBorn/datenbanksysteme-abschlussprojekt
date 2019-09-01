<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Kostümverleih</title>
    </head>
    <body>
<form action="register.php" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Registrierung</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Vorname:
            </td>
            <td>
                <input type="text" name="vorname" size="30" value="">
            </td>
        </tr>
        <tr>
            <td align="right">
                Nachname:
            </td>
            <td>
                <input type="text" name="nachname" size="30" value="">
            </td>
        </tr>
        <tr>
            <td align="right">
                Geschlecht:
                <td><input type="radio" name="geschlecht" value="männlich">
                Männlich
                <input type="radio" name="geschlecht" value="weiblich">
                Weiblich</td>
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Email:
            </td>
            <td>
                <input type="text" name="email">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Passwort:
            </td>
            <td>
                <input type="password" name="passwort" size="30" value="">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Passwort noch einmal eingeben:
            </td>
            <td>
                <input type="password" name="passwort2" size="30" value="">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Registrieren" name="submit">
            </td>
        </tr>
</form>
<?php
include ("db_connect.php");
if (isset($_POST["submit"]))
{
    $vorname=strip_tags(trim($_POST['vorname']));
    $nachname=strip_tags(trim($_POST['nachname']));
    $geschlecht=$_POST['geschlecht'];
    $email=strip_tags(trim($_POST['email']));
    $passwort=strip_tags(trim($_POST['passwort']));
    $passwort2=strip_tags(trim($_POST['passwort2']));
    #Falls Pflichtfelder leer sind -> Fehlermeldung
    if (empty($email) or empty($passwort) or empty($passwort2) or empty($geschlecht))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
            Bitte füllen Sie die Pflichtfelder aus</font></td></tr>";
    }
    #Überprüfung, ob Email Adresse gültig ist
    elseif (!preg_match("/^[0-9a-zäüöÄÜÖ]+[_\.0-9a-z\-äüöÄÜÖ]*\@([0-9a-zäüöÄÜÖ]+[0-9a-z\-_äüöÄÜÖ]*\.){1,5}(de|com|net|org){1}$/i", $email))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
            Geben Sie eine gültige Email Adresse ein</font></td></tr>";
    }
    else 
    {   
        #Überprüfen, ob Passwörter übereinstimmen
        if ($passwort != $passwort2)
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
                Passwörter stimmen nicht überein!</font></td></tr>";
            break;
        }
        {
        #Eintrag in Datenbank, falls alle Eingaben valide sind
        $eintrag="INSERT INTO Kunde
                    (Vorname, Nachname, Geschlecht, Email, Passwort)
                    VALUES
                    ('$vorname', '$nachname', '$geschlecht',
                        '$email', '$passwort')";
        }
        if (mysqli_query($db, $eintrag)) 
        {
            include ("register_succesful.php");
        }
        #Falls Email Adresse schon vergeben -> Fehlermeldung
        if (substr(mysqli_error($db),0,15))
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
                Email Adresse schon vergeben</font></td></tr>";
        }
    }
    mysqli_close($db);
}

?>
    </table>
</body>
</html>