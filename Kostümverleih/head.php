<!-- Navigation für den Kundenbereich -->
<?php include ("auth.php"); ?>
<table width="100%" align="center" border="0">
    <tr>
        <td align="right">
            <h1>Kostümverleih</h1>
            <table align="right" cellpadding="5" border="0">
                <tr>     
                    <td>Startseite</td> 
                    <td>Produkte Ausleihen</td>
                    <td>Produkte Bewerten</td>
                    <td>Suche</td>
                    <td>Profil</td>
                </tr>
                <tr>     
                    <td>
                        <br />
                        <a href="index.php?content=start">anzeigen</a>
                    </td> 
                    <td>
                        <a href="index.php?content=lend_product">Zur Ausleihe</a> <br> 
                        <a href="index.php?content=show_lendings">Meine Ausleihen</a>
                    </td>
                    <td>
                        <a href="index.php?content=show_ratings">Meine Bewertungen</a>
                    </td>
                    <td>
                        <a href="index.php?content=search_productname">Produkte nach Bezeichnung suchen</a> <br>
                        <a href="index.php?content=search_occasion">Produkte nach Anlass suchen</a> <br>
                        <a href="index.php?content=search_theme">Produkte nach Thema suchen</a> <br>
                        <a href="index.php?content=search_price">Produkte nach Preis suchen</a> <br>
                        <a href="index.php?content=search_sex">Produkte nach Geschlecht suchen</a> <br>
                        <a href="index.php?content=search_image">Produkte mit oder ohne Bilder suchen</a> <br>
                    </td>
                    <td>
                        <a href="index.php?content=update_user">Mein Profil</a> <br>
                    <td>
                        <a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/logout.php">Ausloggen</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>