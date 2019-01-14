<?php

    require_once('../../config.php');

    $local_arr_retailer = array();
    $local_retailer = new Retailer();
    $local_retailerDAO = new RetailerDAO();

    /*$retailer_id = (isset($_REQUEST['retailer_id']) ? $_REQUEST['retailer_id'] : '');
    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $local_retailer->set_retailer_id($retailer_id);
    $local_retailer->set_name($name);*/

    $local_arr_retailer = $local_retailerDAO->list($local_retailer);

    require_once('../../view/retailers/frm_list_retailers.php');

?>
