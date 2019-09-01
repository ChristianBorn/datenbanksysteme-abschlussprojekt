<!-- Funktion zur Eingabe des Zeitraums einer Ausleihe -->
<?php include ("auth.php"); 
$produkt_id=$_GET["produkt_id"];?>
<form action="index.php?content=lend_time&produkt_id=<?php echo $produkt_id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Bitte wählen Sie einen Zeitraum für die Ausleihe</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Startdatum:
            </td>
            <td>
                <input type="text" name="start" size="30" value="YYYY-MM-DD">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Enddatum:
            </td>
            <td>
                <input type="text" name="ende" size="30" value="YYYY-MM-DD">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Zeitraum auswählen" name="submit">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    #Speichern der eingegebenen Daten in eine Session
    session_start();
    $_SESSION["produkt_id"]=$produkt_id;
    $_SESSION["start"]=$_POST['start'];
    $_SESSION["ende"]=$_POST['ende'];
    #Überprüfung des Datums auf Gültigkeite
    if (preg_match("/\d{4}-\d{2}-\d{2}/", $_POST['start']) == 1 and preg_match("/\d{4}-\d{2}-\d{2}/", $_POST['ende']))
    {
        #Weiterleitung auf die Ausleihe für verfügbare Exemplare, falls Zeitraum gültig
        header("Location:http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=lend_item");
    }
    else
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie ein gültiges Datum im Format YYYY-MM-DD ein</font></td></tr>";
    }
}

?>

    </table>