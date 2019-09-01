<!-- Funktion zur Bewertung eines Ausgewählten Produkts -->
<?php include ("auth.php"); 
$produkt_id=$_GET["produkt_id"];?>
<form action="index.php?content=add_rating&produkt_id=<?php echo $produkt_id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Produkt Bewerten</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Punkte von 1 bis 10:
            </td>
            <td>
                <input type="text" name="punkte" value="1">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="right">
                Kommentar:
            </td>
            <td>
                <textarea cols="50" rows="10" name="kommentar"></textarea>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Bewertung abschicken" name="submit">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    #Speichern des Users in eine Session
    session_start();
    $user_id=$_SESSION["user_id"];

    $punkte=strip_tags(trim($_POST['punkte']));
    $kommentar=strip_tags(trim($_POST['kommentar']));
    #Überprüfung, ob Punkte vergeben wurden
    if (empty($punkte))
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte vergeben Sie Punkte</font></td></tr>";
    }
    #Überprüfung, ob eine gültige Punktzahl eingegeben wurde
    elseif (!is_numeric($punkte) or number_format($punkte, 2, ",", "") < 0 or number_format($punkte, 2, ",", "") > 10 )
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie eine gültige Punktzahl zwischen 1 und 10 ein</font></td></tr>";
    }
    else
    {
        #Falls alle Eingaben valide -> Datenbankeintrag
        $eintrag="INSERT INTO Bewertung
                    (Punkte, Kommentar, KundenNr, ProduktID)
                    VALUES
                    ('$punkte', '$kommentar', '$user_id', '$produkt_id')";

        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align='center'>Eintrag erfolgreich</p>";
        }
        else 
        {
            echo mysqli_error($db);
        }
        
        mysqli_close($db);
    }
}

?>

    </table>