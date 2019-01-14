<?php

    ob_start();

    require_once('../../config.php');

    $local_arr_retailer = array();
    $local_retailer = new Retailer();
    $local_retailerDAO = new RetailerDAO();

    $name = (isset($_REQUEST['name']) ? $_REQUEST['name'] : '');
    $url = (isset($_REQUEST['website']) ? $_REQUEST['website'] : '');
    $description = (isset($_REQUEST['description']) ? $_REQUEST['description'] : '');
    $local_retailer->set_name($name);
    $local_retailer->set_url($url);
    $local_retailer->set_description($description);

    // handling attached file... Warning: it is a primitive solution...
    $logo_url = hash('sha256', date_timestamp_get(date_create())) . '.jpg';
    $uploads_dir = '../../uploads';
    $error = $_FILES["logo"]["error"];
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["logo"]["tmp_name"];
        $name = basename($_FILES["logo"]["name"]);
        move_uploaded_file($tmp_name, "$uploads_dir/retailers/$logo_url");
    }
    $local_retailer->set_logo_url($logo_url);

    // ToDo: check all fields here in server side and return error in case they
    // are not filled.
    $ret = "";

    if ($local_retailerDAO->insert($local_retailer) == 0) {
        $ret = json_encode(array("success" => false,
                                 "msg_error" => utf8_encode('Error while inserting retailer.')));
    } else {
        $ret = json_encode(array("success" => true,
                                 "msg_success" => utf8_encode('New retailer created.' . $name)));
    }

    ob_clean();

    // Returns JSON document...
    header("Content-Type: application/json");

    echo $ret;

?>
