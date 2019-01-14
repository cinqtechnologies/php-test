<?php

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
    if (count($local_arr_retailer) == 0) {
        $local_retailer->set_retailer_id(0);
    } else {
        $local_retailer = $local_arr_retailer[0];

        // list products from this retailer...
        $local_product->get_retailer()->set_retailer_id($local_retailer->get_retailer_id());
        $local_arr_product = $local_productDAO->list($local_product);
    }

    require_once('../../view/retailers/frm_list_retailer.php');

?>
