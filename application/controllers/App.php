<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct() {
      	parent::__construct(); 
      	$this->load->model('ProductModel');
      	$this->load->model('RetailerModel');
  	}

	public function index() {
		$retailerDetails = 
		$retailerId = $this->input->get('retailer');
		$products = $this->ProductModel->getProducts(null,$retailerId);
		if(is_numeric($retailerId)) {
			$retailerDetails = $this->RetailerModel->getDetails($retailerId);
		}
		//var_dump($this->uri->segment(2)); exit;
		$this->load->view('header');
		$this->load->view('product-list',['products' => $products, 'retailer_details' => $retailerDetails]);
		$this->load->view('footer');
	}

	public function createProduct() {
		$retailers = $this->RetailerModel->getRetailers();

		$this->load->view('header');
		$this->load->view('product-create',['retailers' => $retailers]);
		$this->load->view('footer');
	}

	public function productDetails() {
		$this->load->view('header');
		$product = $this->ProductModel->getProducts($this->uri->segment(3),null);
		$this->load->view('product-details',['product' => $product]);
		$this->load->view('footer');
	}

	public function createRetailer() {
		$this->load->view('header');
		$this->load->view('retailer-create');
		$this->load->view('footer');
	}

	public function retailerDetails() {
		$this->load->view('header');
		$this->load->view('footer');
	}
}