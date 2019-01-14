<?php

class Retailer implements \JsonSerializable {

    private $retailer_id;
    private $name;
    private $logo_url;
    private $url;
    private $description;

    // for json...
    private $products;

    function __construct() {
        $this->retailer_id = "";
        $this->name = "";
        $this->logo_url = "";
        $this->url = "";
        $this->description = "";
    }

    function get_retailer_id() {
        return $this->retailer_id;
    }

    function set_retailer_id($retailer_id) {
        $this->retailer_id = $retailer_id;
    }

    function get_name() {
        return $this->name;
    }

    function set_name($name) {
        $this->name = $name;
    }

    function get_logo_url() {
        return $this->logo_url;
    }

    function set_logo_url($logo_url) {
        $this->logo_url = $logo_url;
    }

    function get_url() {
        return $this->url;
    }

    function set_url($url) {
        $this->url = $url;
    }

    function get_description() {
        return $this->description;
    }

    function set_description($description) {
        $this->description = $description;
    }

    function get_products() {
        return $this->products;
    }

    function set_products($products) {
        foreach ($products as $product) {
            $product->unset_retailer();
        }
        $this->products = $products;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
    }

}

?>
