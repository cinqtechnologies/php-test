<?php

    require_once('../../config.php');

    $local_arr_product = array();
    $local_product = new Product();
    $local_productDAO = new ProductDAO();

    /*$prod_id = (isset($_REQUEST['prod_id']) ? $_REQUEST['prod_id'] : '');
    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $local_product->set_prod_id($prod_id);
    $local_product->set_name($name);*/

    $local_arr_product = $local_productDAO->list($local_product);

    require_once('../../view/products/frm_list_products.php');

?>
