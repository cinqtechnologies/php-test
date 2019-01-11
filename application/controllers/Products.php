<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct() {
      	parent::__construct(); 
  	}

	public function index() {
		$this->load->model('ProductModel');
		$products = $this->ProductModel->getProducts($this->uri->segment(2),null);
		header('Content-Type: application/json');
		echo json_encode($products);
	}
}