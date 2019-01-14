<?php
    require_once('../../res/header.php');
?>

<script>
function sendEmail(e) {
    e.preventDefault();
    var xhttp = new XMLHttpRequest();
    var prod_id = <?php echo $local_product->get_prod_id(); ?>;
    xhttp.onreadystatechange = function() {
        var data;
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);
            // 50% chance of success in ajax_info_product.php...
            if (data.success) {
                alert('Well done... ' + data.msg_success);
            } else {
                alert('Hmmm... ' + data.msg_error);
            }
        }
    };
    xhttp.open("GET", "ajax_info_product.php?prod_id=" + prod_id + "&email=" + document.getElementById('email').value, true);
    xhttp.send();

    return false;
}
</script>

<?php

    if ($local_product->get_prod_id() == 0) {
        echo "<div class=\"main_container\">\n";
            echo "<span class=\"error\">Error: product not found...</span>\n";
        echo "</div>\n";
    } else {
        echo "<h2 class=\"ads\">Product details for <b>" . $local_product->get_name(). "</b></h2>\n";
        echo "<div class=\"main_container\">\n";
        echo "<table class=\"tb_description\">\n";
        echo "  <tr>\n";
        echo "      <th>#</th>\n";
        echo "      <th>ID</th>\n";
        echo "      <th>Name</th>\n";
        echo "      <th>Price</th>\n";
        echo "      <th>Description</th>\n";
        echo "      <th>Retailer</th>\n";
        echo "  </tr>\n";
            echo "  <tr>\n";
            echo "      <td class=\"td_image\"><img src=\"../../../uploads/products/" . $local_product->get_image_url() . "\"></td>\n";
            echo "      <td><a href=\"../products/list_product.php?prod_id=" . $local_product->get_prod_id() . "\">" . $local_product->get_prod_id() . "</a></td>\n";
            echo "      <td><a href=\"../products/list_product.php?prod_id=" . $local_product->get_prod_id() . "\">" . $local_product->get_name() . "</a></td>\n";
            echo "      <td>$" . $local_product->get_price() . "</td>\n";
            echo "      <td>" . $local_product->get_description() . "</td>\n";
            echo "      <td><a href=\"../retailers/list_retailer.php?retailer_id=" . $local_product->get_retailer()->get_retailer_id() . "\">" . $local_product->get_retailer()->get_name() . "</a></td>";
            echo "  </tr>\n";
        echo "</table>\n\n";

        echo "<br>\n\n";

        echo "<h2 class=\"ads\">Receive more information about <b>" . $local_product->get_name(). "</b>...</h2>\n";
        echo "<form action=\"ajax_info_product.php\" onsubmit=\"return sendEmail(event);\">";
        echo "  <input type=\"text\" id=\"email\" name=\"email\" placeholder=\"email@server.com\" required></input>";
        echo "  <input type=\"submit\" value=\"Send more information...\"></input>";
        echo "</form><br>";

        echo "</div>\n";
    }

    require_once('../../res/footer.php');
?>
