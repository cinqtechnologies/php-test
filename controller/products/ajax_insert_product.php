<?php

    ob_start();

    require_once('../../config.php');

    $local_arr_product = array();
    $local_product = new Product();
    $local_productDAO = new ProductDAO();

    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $retailer_id = (isset($_REQUEST['retailer_id']) ? $_REQUEST['retailer_id'] : '');
    $price = (isset($_REQUEST['price']) ? $_REQUEST['price'] : '');
    $description = (isset($_REQUEST['description']) ? $_REQUEST['description'] : '');
    $local_product->set_name($name);
    $local_product->set_retailer_id($retailer_id);
    $local_product->set_price($price);
    $local_product->set_description($description);

    // handling attached file... Warning: it is a primitive solution...
    $image_url = hash('sha256', date_timestamp_get(date_create())) . '.jpg';
    $uploads_dir = '../../uploads';
    $error = $_FILES["image"]["error"];
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["image"]["tmp_name"];
        $name = basename($_FILES["image"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/products/$image_url");
    }
    $local_product->set_image_url($image_url);

    // ToDo: check all fields here in server side and return error in case they
    // are not filled.

    $ret = "";

    if ($local_productDAO->insert($local_product) == 0) {
        $ret = json_encode(array("success" => false,
                                 "msg_error" => utf8_encode('Error while inserting product.')));
    } else {
        $ret = json_encode(array("success" => true,
                                 "msg_success" => utf8_encode('New product created.')));
    }

    ob_clean();

    // Returns JSON document...
    header("Content-Type: application/json");

    echo $ret;

?>
