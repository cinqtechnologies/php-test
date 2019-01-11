<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct() {
      	parent::__construct(); 
      	$this->load->model('ProductModel');
      	$this->load->model('RetailerModel');
      	$this->load->library('form_validation');
  	}

	public function index() {
		$retailerDetails = null;
		$retailerId = $this->input->get('retailer');
		$products = $this->ProductModel->getProducts(null,$retailerId, 'DESC');
		if(is_numeric($retailerId)) {
			$retailerDetails = $this->RetailerModel->getDetails($retailerId);
		}
		$this->load->view('header');
		$this->load->view('product-list',['products' => $products, 'retailer_details' => $retailerDetails, 'retailer_id' => $retailerId]);
		$this->load->view('footer');
	}

	public function productDetails() {
		$this->load->view('header');
		$product = $this->ProductModel->getProducts($this->uri->segment(3),null);
		$this->load->view('product-details',['product' => $product]);
		$this->load->view('footer');
	}

	public function createProduct() {
		$retailers = $this->RetailerModel->getRetailers();
		$this->load->view('header');
		$this->load->view('product-create',['retailers' => $retailers]);
		$this->load->view('footer');
	}

	public function storeProduct() {
		$this->form_validation->set_rules('product_retailer', 'Retailer', 'required');
		$this->form_validation->set_rules('product_name', 'Product name', 'trim|required|min_length[2]|max_length[20]');
		$this->form_validation->set_rules('image', 'Image', "callback_file_check");
		$this->form_validation->set_rules('product_price', 'Price', 'required|greater_than[0]');
		$this->form_validation->set_rules('product_description', 'Description', 'trim|required|min_length[5]|max_length[200]');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('last_post', $_POST);
			redirect(base_url('app/create-product'));
		} else {
			$fileData = 'data:'.$_FILES['image']['type'].';base64,' . base64_encode(file_get_contents($_FILES['image']['tmp_name']));

			$insertData = [
				'retailer_id' => $this->input->post('product_retailer'),
				'name' => html_escape($this->input->post('product_name')),
				'image' => $fileData,
				'price' => $this->input->post('product_price'),
				'description' => html_escape($this->input->post('product_description'))
			];
			$this->ProductModel->insert($insertData);
			$this->session->set_flashdata('success', 'Product added succesfully');
			redirect(base_url('app/create-product'));
		}
    }

	public function createRetailer() {
		$this->load->view('header');
		$this->load->view('retailer-create');
		$this->load->view('footer');
	}

    public function storeRetailer() {
    	$this->form_validation->set_rules('retailer_name', 'Retailer', 'trim|required|min_length[2]|max_length[20]');
		$this->form_validation->set_rules('image', 'Logo', "callback_file_check");
		$this->form_validation->set_rules('retailer_website', 'Price', 'trim|required|min_length[5]|max_length[80]');
		$this->form_validation->set_rules('retailer_description', 'Description', 'trim|required|min_length[5]|max_length[200]');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('last_post', $_POST);
			redirect(base_url('app/create-retailer'));
		} else {
			$fileData = 'data:'.$_FILES['image']['type'].';base64,' . base64_encode(file_get_contents($_FILES['image']['tmp_name']));
			$insertData = [
				'name' => html_escape($this->input->post('retailer_name')),
				'logo' => $fileData,
				'website' => html_escape($this->input->post('retailer_website')),
				'description' => html_escape($this->input->post('retailer_description'))
			];
			$this->RetailerModel->insert($insertData);
			$this->session->set_flashdata('success', 'Retailer added succesfully');
			redirect(base_url('app/create-retailer'));
		}
    }

    public function file_check() {
    	if(!isset($_FILES['image']['name']) || strlen($_FILES['image']['name']) == 0){
    		$this->form_validation->set_message( __FUNCTION__ , 'The {field} field is required');
    		return false;
    	} else if(!in_array($_FILES['image']['type'], ['image/jpeg','image/png'])) {
    		$this->form_validation->set_message( __FUNCTION__ , 'The {field} file type is not supported. Accepted formats: jpeg,png');
    		return false;
    	} else if($_FILES['image']['size'] > 500000) {
    		$this->form_validation->set_message( __FUNCTION__ , 'The max permitted {field} size is 500kb');
    		return false;
    	}

		return true;
    }

    public function sendMockEmail() {
    	$this->form_validation->set_rules('user_email', 'Email', 'trim|required|valid_email');

    	if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('errors', validation_errors());
			$this->session->set_flashdata('last_post', $_POST);
		} else {
			$product = $this->ProductModel->getProducts($this->uri->segment(3),null);
			$this->load->helper('email_helper');
			$emailText = email_content($this->input->post('user_email'), $product);

			if($emailText === false || !write_file(FCPATH . 'mock_email/' . date('d-m-YHis') . '.txt', $emailText, 'w+')) {
				$this->session->set_flashdata('errors', 'An error ocurred while sending email.');
			} else {
				$this->session->set_flashdata('success', 'Email sent successfully!');
			}
		}

		redirect(base_url('app/product-details/'.$this->uri->segment(3)));
    }

}