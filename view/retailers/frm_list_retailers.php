<?php
    require_once('../../res/header.php');

    echo "<h2 class=\"ads\">Retailers</h2>\n";

    echo "<div class=\"main_container\">\n";
    echo "<form action=\"insert_retailer.php\"><input type=\"submit\" value=\"Add new Retailer...\"></input></form><br>\n";
    echo "<table class=\"tb_description\">\n";
    echo "  <tr>\n";
    echo "      <th>#</th>\n";
    echo "      <th>ID</th>\n";
    echo "      <th>Name</th>\n";
    echo "      <th>Website</th>\n";
    echo "      <th>Description</th>\n";
    echo "  </tr>\n";
    foreach ($local_arr_retailer as $local_retailer) {
        echo "  <tr>\n";
        echo "      <td class=\"td_image\"><img src=\"../../../uploads/retailers/" . $local_retailer->get_logo_url() . "\"></td>\n";
        echo "      <td><a href=\"list_retailer.php?retailer_id=" . $local_retailer->get_retailer_id() . "\">" . $local_retailer->get_retailer_id() . "</a></td>\n";
        echo "      <td><a href=\"list_retailer.php?retailer_id=" . $local_retailer->get_retailer_id() . "\">" . $local_retailer->get_name() . "</a></td>\n";
        echo "      <td><a href=\"" . $local_retailer->get_url() . "\">" . $local_retailer->get_url() . "</a></td>\n";
        echo "      <td>" . $local_retailer->get_description() . "</td>\n";
        echo "  </tr>\n";
    }
    echo "</table>\n";
    echo "</div>\n";

    require_once('../../res/footer.php');
?>
