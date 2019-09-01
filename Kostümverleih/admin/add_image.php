<!-- Funktion zum Hinzufügen eines neuen Bildes zu einem Produkt -->
<?php include ("auth_admin.php");
$id=$_GET["id"];?>
<form action="index.php?content=add_image&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
    <table align="center" bgcolor="#E0E0E0" cellspacing="5" cellpadding="5">
        <tr>
            <td align="center" colspan="2">
                <h3>Bild hinzufügen</h3>
            </td>
        </tr>
        <tr>
            <td align="right">
                Bilddatei auswählen:
            </td>
            <td>
                <input type="file" name="bild" size="30">
            </td>
            <td>
                <font size="2" color="red">*</font>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="3">
                <font size="2" color="red">*Pflichtfeld(er)</font><br />
                <input type="submit" value="Hochladen" name="submit">
            </td>
        </tr>
</form>
<?php
if (isset($_POST["submit"]))
{
    #Kontrolle, ob eine Datei hochgeladen wurde
    if (array_key_exists("bild", $_FILES))
    {
        $tmpname = $_FILES["bild"]["tmp_name"];
        $image_type = $_FILES["bild"]["type"];
        $filehandler = fopen($tmpname, "r");
        $image_data = addslashes(fread($filehandler, filesize($tmpname)));
    #Kontrolle, ob Datei ein Bild ist
    if (substr($image_type,0,5) == "image")
    {
        #Eintrag des Bildes und des Bildtyps in Datenbank
        $eintrag="INSERT INTO Bild
                (Bild, Bild_Typ)
                VALUES
                ('$image_data', '$image_type')";
    }
    else
    {
        echo "<tr><td align='center' colspan='3'><font color='red'>
                Kein gültiges Bildformat</font></td></tr>";
    }
    #Falls das Bild eingetragen wurde, wird noch ein Eintrag in Produkt_Bild zur Zuordnung des Bildes zum Produkt angelegt
    if (mysqli_query($db, $eintrag))
    {
        #Eintrag in Datenbank
        $eintrag="INSERT INTO Produkt_Bild
                VALUES
                ('$id', (SELECT BildID FROM Bild ORDER BY BildID DESC LIMIT 1))";
        if (mysqli_query($db, $eintrag)) 
        {
            echo "<p align='center'>Eintrag erfolgreich<br>Sie werden weitergeleitet</p>";
            header ("Refresh: 2; URL=http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kost%C3%BCmverleih/index.php?content=show_products");  
        }
        else 
        {
            echo mysqli_error($db);
        }
    }
}

}

?>

    </table>