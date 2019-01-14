<?php

class Product implements \JsonSerializable {

    private $prod_id;
    private $name;
    private $price;
    private $image_url;
    private $description;
    private $retailer_id;

    // foreign...
    private $retailer;

    function __construct() {
        $this->prod_id = "";
        $this->name = "";
        $this->price = "";
        $this->image_url = "";
        $this->description = "";
        $this->retailer = new Retailer();
    }

    function get_prod_id() {
        return $this->prod_id;
    }

    function set_prod_id($prod_id) {
        $this->prod_id = $prod_id;
    }

    function get_name() {
        return $this->name;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function get_price() {
        return $this->price;
    }

    function set_price($price) {
        $this->price = $price;
    }

    function get_image_url() {
        return $this->image_url;
    }

    function set_image_url($image_url) {
        $this->image_url = $image_url;
    }

    function get_description() {
        return $this->description;
    }

    function set_description($description) {
        $this->description = $description;
    }

    function get_retailer_id() {
        return $this->retailer_id;
    }

    function set_retailer_id($retailer_id) {
        $this->retailer_id = $retailer_id;
    }

    function get_retailer() {
        return $this->retailer;
    }

    function set_retailer(Retailer $retailer) {
        $this->retailer = $retailer;
    }

    function unset_retailer() {
        unset($this->retailer);
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

?>
