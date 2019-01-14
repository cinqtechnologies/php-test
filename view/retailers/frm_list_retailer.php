<?php
    require_once('../../res/header.php');

    if ($local_retailer->get_retailer_id() == 0) {
        echo "<div class=\"main_container\">\n";
            echo "<span class=\"error\">Error: retailer not found...</span>\n";
        echo "</div>\n";
    } else {
        echo "<h2 class=\"ads\">Retailer details for <b>" . $local_retailer->get_name(). "</b></h2>\n";
        echo "<div class=\"main_container\">\n";
        echo "<table class=\"tb_description\">\n";
        echo "  <tr>\n";
        echo "      <th>#</th>\n";
        echo "      <th>ID</th>\n";
        echo "      <th>Name</th>\n";
        echo "      <th>Website</th>\n";
        echo "      <th>Description</th>\n";
        echo "  </tr>\n";
        echo "  <tr>\n";
        echo "      <td class=\"td_image\"><img src=\"../../../uploads/retailers/" . $local_retailer->get_logo_url() . "\"></td>\n";
        echo "      <td>" . $local_retailer->get_retailer_id() . "</td>\n";
        echo "      <td>" . $local_retailer->get_name() . "</td>\n";
        echo "      <td><a href=\"" . $local_retailer->get_url() . "\">" . $local_retailer->get_url() . "</a></td>\n";
        echo "      <td>" . $local_retailer->get_description() . "</td>\n";
        echo "  </tr>\n";
        echo "</table>\n";

        echo "<h2 class=\"ads\">Products of <b>" . $local_retailer->get_name(). "</b></h2>\n";
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
            echo "      <td class=\"td_image\"><img src=\"../../../uploads/products/" . $local_product->get_image_url() . "\"></td>\n\n";
            echo "      <td><a href=\"../products/list_product.php?prod_id=" . $local_product->get_prod_id() . "\">" . $local_product->get_prod_id() . "</a></td>\n";
            echo "      <td><a href=\"../products/list_product.php?prod_id=" . $local_product->get_prod_id() . "\">" . $local_product->get_name() . "</a></td>\n";
            echo "      <td>" . $local_product->get_image_url() . "</td>\n";
            echo "      <td>" . $local_product->get_description() . "</td>\n";
            echo "  </tr>\n";
        }
        echo "</table>\n";

        echo "</div>\n";
    }

    require_once('../../res/footer.php');
?>
