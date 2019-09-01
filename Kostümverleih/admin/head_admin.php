<!-- Navigation des Mitarbeiterbereichs -->
<?php include ("auth_admin.php"); ?>
<table width="100%" align="center" border="0">
    <tr>
        <td align="right">
            <h1>Kostümverleih</h1>
            <table align="right" cellpadding="5" border="0">
                <tr>     
                    <td>Startseite</td> 
                    <td>Produkte</td>
                    <td>Produktexemplare</td>
                    <td>Themen</td>
                    <td>Anlässe</td>
                    <td>Ausleihen</td>
                    <td>Kunden</td>
                </tr>
                <tr>     
                    <td>
                        <br />
                        <a href="index.php?content=start">anzeigen</a>
                    </td> 
                    <td>
                        <a href="index.php?content=add_product">hinzuf&uuml;gen</a> <br> 
                        <a href="index.php?content=show_products">anzeigen</a>
                    </td>
                    <td>
                        <a href="index.php?content=add_item">hinzuf&uuml;gen</a> <br>
                        <a href="index.php?content=show_items">anzeigen</a>
                    </td>
                    <td>
                        <a href="index.php?content=add_theme">hinzuf&uuml;gen</a> <br>
                        <a href="index.php?content=show_themes">anzeigen</a>
                    </td>
                    <td>
                        <a href="index.php?content=add_occasion">hinzuf&uuml;gen</a> <br>
                        <a href="index.php?content=show_occasions">anzeigen</a>
                    </td>
                    <td>
                        <a href="index.php?content=show_lendings_admin">anzeigen</a>
                    </td>
                    <td>
                        <a href="index.php?content=show_customers">anzeigen</a>
                    </td>
                    <td>
                        <a href="http://dbcip.cs.uni-duesseldorf.de/~m2027751/Kostümverleih/logout.php">Ausloggen</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>