<!-- Funktion zur Zuordnung von Themen zu einem Produkt -->
<?php include ("auth_admin.php"); 
$id=$_GET["id"];?>
<form action="index.php?content=category_theme&id=<?php echo $id; ?>" method="post">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Themen zum Produkt hinzufügen</h3>
                Es werden nur noch nicht vergebene Themen angezeigt
            </td>
        </tr>
            <td align="right">
                Gehört zu Thema:
            </td>
            <td>
                <select multiple="multiple" name="thema_produkt[]" size="5">
                    <?php
                        #Anzeigen der vorhandenen und noch nicht für dieses Produkt vergebenen Themen
                        $anfrage = "SELECT Bezeichnung
                                    FROM Thema
                                    WHERE Bezeichnung NOT IN (
                                        SELECT Bezeichnung FROM Produkt_Thema WHERE ProduktID = '$id')";
                        $result = mysqli_query($db, $anfrage);
                        echo "<option disabled selected>Wählen Sie ein oder mehrere Themen mit strg</option>";
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo "<option>".$row['Bezeichnung']."</option>";
                        }
                    ?>
                </select>
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
    $thema_produkt=$_POST['thema_produkt'];
    $number_thema=count($thema_produkt);
    $counter_thema=0;
    #Falls mindestens ein Thema asugewählt wurde
    if ($number_thema != 0)
    {   
        #Durchlaufen der asugewählten Themen
        foreach ($thema_produkt as $var) 
        {
            #Eintrag des Themas für das gewählte Produkt
            $eintrag="INSERT INTO Produkt_Thema
                        VALUES ('$id', '$var')";
            if (mysqli_query($db,$eintrag))
            {
                $counter_thema=$counter_thema+1;
            }
        }
    
        if ($number_thema == $counter_thema)
        {
            echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_products");
        }
        }
        else
        {
            echo "<tr><td align='center' colspan='3'><font color='red'>
        Bitte geben Sie mindestens ein Thema an</font></td></tr>";
        }

        mysqli_close($db);

}
?>

    </table>