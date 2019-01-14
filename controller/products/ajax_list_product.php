<?php

    ob_start();

    require_once('../../config.php');

    $local_arr_product = array();
    $local_product = new Product();
    $local_productDAO = new ProductDAO();
    $local_retailerDAO = new RetailerDAO();

    $prod_id = (isset($_REQUEST['prod_id']) ? $_REQUEST['prod_id'] : '0');
    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $local_product->set_prod_id($prod_id);
    $local_product->set_name($name);

    if ($prod_id != 0) {
        $local_arr_product = $local_productDAO->list($local_product);
    }
    foreach ($local_arr_product as $local_product) {
        $local_product->set_retailer($local_retailerDAO->list($local_product->get_retailer())[0]);
        echo $local_product->get_prod_id() . ' - '
           . $local_product->get_name() . ' - '
           . $local_product->get_retailer()->get_retailer_id() . ' - '
           . $local_product->get_image_url() . ' - '
           . $local_product->get_description() . ' - '
           . "<br>";
        $local_product->unset_retailer(); 
    }

    ob_clean();

    // Returns JSON document...
    header("Content-Type: application/json");

    $ret = json_encode(array("qty" => count($local_arr_product),
                             "products" => $local_arr_product));

    echo $ret;

?>
