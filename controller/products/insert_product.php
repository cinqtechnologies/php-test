<?php

    require_once('../../config.php');

    $local_arr_retailer = array();
    $local_retailer = new Retailer();
    $local_retailerDAO = new RetailerDAO();

    $local_arr_retailer = $local_retailerDAO->list($local_retailer);

    require_once('../../view/products/frm_insert_product.php');

?>
