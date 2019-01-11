<?php

class RetailerModel extends CI_Model {

	public function insert($data) {
		$this->db->insert('retailer', $data);
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
					retailer AS r 
				WHERE r.id = ' . (int) $retailerId ;

		if(is_numeric($retailerId)) {
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$result = $rs->row();
			}
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
					retailer AS r ';

		$rs = $this->db->query($sql);
		
		while ($row = $rs->unbuffered_row()) {
			array_push($result, $row);
		}

		return $result;
	}

}