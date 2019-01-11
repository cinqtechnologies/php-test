<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Retailer extends CI_Controller {

	public function __construct() {
      	parent::__construct(); 
  	}

	public function index() {
		$this->load->model('RetailerModel');
		$this->load->model('ProductModel');
		$retailerId = $this->uri->segment(2);
		$details = $this->RetailerModel->getDetails($retailerId);
		$retailerProducts = (!is_null($retailerId) && is_numeric($retailerId)) ? $this->ProductModel->getProducts(null,$retailerId) : [];
		header('Content-Type: application/json');
		echo json_encode(['details' => $details,'products' => $retailerProducts]);
	}
}