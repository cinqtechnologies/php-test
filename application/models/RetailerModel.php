<?php

class RetailerModel extends CI_Model {

	public function insert() {
		$sql = "INSERT INTO retailer (name, logo, website, description) VALUES ('TEST retailer', 'logo.png', 'www.website.com', 'RETAILER DESCRIPTION');";
	}

	public function getDetails($retailerId = 0) {
		$result = [];

		$sql = 'SELECT 
					r.id,
					r.name,
					r.description,
					r.logo,
					r.website
				FROM 
					ecommerce_test.retailer AS r 
				WHERE r.id = ' . (int) $retailerId ;

		if(is_numeric($retailerId)) {
			$rs = $this->db->query($sql);
			$result = $rs->row();
		}

		return $result;
	}

	public function getRetailers() {
		$result = [];
		$sql = 'SELECT 
					r.id,
					r.name,
					r.description,
					r.website
				FROM 
					ecommerce_test.retailer AS r ';

		$rs = $this->db->query($sql);
		//echo '<pre>'; var_dump($rs);
		while ($row = $rs->unbuffered_row()) {
			array_push($result, $row);
		}

		return $result;
	}

}