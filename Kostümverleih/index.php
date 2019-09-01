<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Kostümverleih</title>
    </head>
    <body>
        <table width="1024" align="center" border="0">  <!-- table for design purposes: center alignment -->
            <tr>
                <td>
                    <?php
                    #Datenbankverbindung
                    include("db_connect.php");
                    #check, ob User angemeldet
                    include ("auth.php");
                    #Falls User als Mitarbeiter angemeldet -> Mitarbeiterbereich anzeigen
                    if ($_SESSION["admin"] == 1)
                    {
                     include("admin/head_admin.php");
                     echo "Mitarbeiterbereich</br>";
                    }
                    #Ansonsten Kundenbereich anzeigen
                    else 
                    {
                        include("head.php");
                        echo "Kundenbereich";
                    }
                    ?>
                    <?php
                    switch ($_GET['content']) {
                        case "add_product":
                            include("admin/add_product.php");
                            break;
                        case "add_item":
                            include("admin/add_item.php");
                            break;
                        case "add_theme":
                            include("admin/add_theme.php");
                            break;
                        case "add_occasion":
                            include("admin/add_occasion.php");
                            break;
                        case "show_customers":
                            include("admin/show_customers.php");
                            break;
                        case "show_themes":
                            include("admin/show_themes.php");
                            break;
                        case "show_occasions":
                            include("admin/show_occasions.php");
                            break;
                        case "show_products":
                            include("admin/show_products.php");
                            break;
                        case "show_items":
                            include("admin/show_items.php");
                            break;
                        case "lend_product":
                            include("lend_product.php");
                            break;
                        case "lend_item":
                            include("lend_item.php");
                            break;
                        case "update_user":
                            include("update_user.php");
                            break;
                        case "show_lendings":
                            include("show_lendings.php");
                            break;
                        case "show_lendings_admin":
                            include("admin/show_lendings_admin.php");
                            break;
                        case "add_rating":
                            include("add_rating.php");
                            break;
                        case "search_productname":
                            include("search_productname.php");
                            break;
                        case "search_occasion":
                            include("search_occasion.php");
                            break;
                         case "search_theme":
                            include("search_theme.php");
                            break;
                        case "search_price":
                            include("search_price.php");
                            break;
                        case "search_sex":
                            include("search_sex.php");
                            break;
                        case "search_image":
                            include("search_image.php");
                            break;
                        case "category_occasion":
                            include("admin/category_occasion.php");
                            break;
                        case "category_theme":
                            include("admin/category_theme.php");
                            break;
                        case "category_product":
                            include("admin/category_product.php");
                            break;
                        case "update_product":
                            include("admin/update_product.php");
                            break;
                        case "update_item":
                            include("admin/update_item.php");
                            break;
                        case "update_theme":
                            include("admin/update_theme.php");
                            break;
                        case "update_occasion":
                            include("admin/update_occasion.php");
                            break;
                        case "add_image":
                            include("admin/add_image.php");
                            break;
                        case "show_images":
                            include("admin/show_images.php");
                            break;
                        case "lend_time":
                            include("lend_time.php");
                            break;
                        case "show_ratings":
                            include("show_ratings.php");
                            break;
                        case "similar_products":
                            include("similar_products.php");
                            break;
                        case "images":
                            include("admin/images.php");
                            break;
                        default:
                            include("start.php");
                    }
                    ?>
                    <?php include("foot.php"); ?>
                </td>
            </tr>
        </table>
    </body>
</html>