<?php

class ProductModel extends CI_Model {

	public function insert($data) {
		$this->db->insert('products', $data);
	}

	public function getProducts($productId = 0,$retailerId = 0,$order = 'ASC') {
		$result = [];
		
		$sql = 'SELECT 
					p.id,
					p.name AS product_name,
					p.retailer_id,
					p.price,
					p.image,
					r.name AS retailer_name,
					p.description
				FROM
					products AS p
				INNER JOIN
					retailer AS r
				ON p.retailer_id = r.id ';

		if(is_numeric($productId)) {
			$sql .= 'WHERE p.id = ' . (int) $productId;
		}

		if(is_numeric($retailerId)) {
			$sql .= 'WHERE p.retailer_id = ' . (int) $retailerId;
		}

		if(is_numeric($productId)) {
			$rs = $this->db->query($sql);
			if($rs->num_rows()){
				$result = $rs->row();
			}
		} else if(is_null($productId)) {

			$sql .= ' ORDER BY p.id ' . $order;

			$rs = $this->db->query($sql);
			while ($row = $rs->unbuffered_row()) {
				array_push($result, $row);
			}
		}

		return $result;
	}
}