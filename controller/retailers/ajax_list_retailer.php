<?php

    ob_start();

    require_once('../../config.php');

    $local_arr_product = array();
    $local_product = new Product();
    $local_productDAO = new ProductDAO();
    $local_arr_retailer = array();
    $local_retailer = new Retailer();
    $local_retailerDAO = new RetailerDAO();

    $retailer_id = (isset($_REQUEST['retailer_id']) ? $_REQUEST['retailer_id'] : '0');
    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $local_retailer->set_retailer_id($retailer_id);
    $local_retailer->set_name($name);

    if ($retailer_id != 0) {
        $local_arr_retailer = $local_retailerDAO->list($local_retailer);
    }
    foreach ($local_arr_retailer as $local_retailer) {
        $local_retailer = $local_arr_retailer[0];

        // list products from this retailer...
        $local_product->get_retailer()->set_retailer_id($local_retailer->get_retailer_id());
        $local_arr_product = $local_productDAO->list($local_product);

        $local_retailer->set_products($local_arr_product);
    }

    foreach ($local_arr_retailer as $local_retailer) {
        echo $local_retailer->get_retailer_id() . ' - '
           . $local_retailer->get_name() . ' - '
           . $local_retailer->get_logo_url() . ' - '
           . $local_retailer->get_url() . ' - '
           . $local_retailer->get_description() . ' - '
           . "<br>";
    }

    ob_clean();

    // Returns JSON document...
    header("Content-Type: application/json");

    $ret = json_encode(array("qty" => count($local_arr_retailer),
                             "retailers" => $local_arr_retailer));

    echo $ret;

?>
