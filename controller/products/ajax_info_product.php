<?php

    ob_start();

    require_once('../../config.php');

    $ret = "";
    // 50% chance of success...
    if (rand() < getrandmax() / 2) {
        $ret = json_encode(array("success" => false,
                                 "msg_error" => utf8_encode('Error while sending information. Try again in a few moments, please.')));
    } else {
        $ret = json_encode(array("success" => true,
                                 "msg_success" => utf8_encode('Thank you for your interest. You will receive an e-mail in a few moments.')));
    }

    ob_clean();

    // Returns JSON document...
    header("Content-Type: application/json");

    echo $ret;

?>
