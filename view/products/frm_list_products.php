<?php
    require_once('../../res/header.php');

    echo "<h2 class=\"ads\">Products</h2>\n";

    echo "<div class=\"main_container\">\n";
    echo "<form action=\"insert_product.php\"><input type=\"submit\" value=\"Add new Product...\"></input></form><br>\n";
    echo "<table class=\"tb_description\">\n";
    echo "  <tr>\n";
    echo "      <th>#</th>\n";
    echo "      <th>ID</th>\n";
    echo "      <th>Name</th>\n";
    echo "      <th>Price</th>\n";
    echo "      <th>Description</th>\n";
    echo "  </tr>\n";
    foreach ($local_arr_product as $local_product) {
        echo "  <tr>\n";
        echo "      <td class=\"td_image\"><img src=\"../../../uploads/products/" . $local_product->get_image_url() . "\"></td>\n";
        echo "      <td><a href=\"../products/list_product.php?prod_id=" . $local_product->get_prod_id() . "\">" . $local_product->get_prod_id() . "</a></td>\n";
        echo "      <td><a href=\"../products/list_product.php?prod_id=" . $local_product->get_prod_id() . "\">" . $local_product->get_name() . "</a></td>\n";
        echo "      <td>$" . $local_product->get_price() . "</td>\n";
        echo "      <td>" . $local_product->get_description() . "</td>\n";
        echo "  </tr>\n";
    }
    echo "</table>\n";
    echo "</div>\n";

    require_once('../../res/footer.php');
?>
