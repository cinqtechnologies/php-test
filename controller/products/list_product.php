<?php

    require_once('../../config.php');

    $local_arr_product = array();
    $local_product = new Product();
    $local_productDAO = new ProductDAO();
    $local_arr_retailer = array();
    $local_retailer = new Retailer();
    $local_retailerDAO = new RetailerDAO();

    $prod_id = (isset($_REQUEST['prod_id']) ? $_REQUEST['prod_id'] : '0');
    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $local_product->set_prod_id($prod_id);
    $local_product->set_name($name);

    if ($prod_id != 0) {
        $local_arr_product = $local_productDAO->list($local_product);
    }
    if (count($local_arr_product) == 0) {
        $local_product->set_prod_id(0);
    } else {
        $local_product = $local_arr_product[0];
        $local_product->set_retailer($local_retailerDAO->list($local_product->get_retailer())[0]);

        // list products from this retailer...
        //$local_retailer->get_retailer()->set_retailer_id($local_retailer->get_retailer_id());
        //$local_arr_product = $local_productDAO->list($local_product);
    }

    require_once('../../view/products/frm_list_product.php');

?>
