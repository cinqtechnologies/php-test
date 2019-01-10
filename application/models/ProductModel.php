<?php

class ProductModel extends CI_Model {

	public function insert() {
		$sql = "INSERT INTO ecommerce_test.products (retailer_id, name, image, price, description) VALUES (1,'TEST product', 'img.png', 100.01, 'PRODUCT DESCRIPTION');";
	}

	public function getProducts($productId = 0,$retailerId = 0) {
		$result = [];
		//var_dump(is_numeric($productId));
		//var_dump($productId);
		/*
		-- WHERE p.retailer_id = :retailer_id
		-- WHERE p.id = :product_id
		*/
		$sql = 'SELECT 
					p.id,
					p.name AS product_name,
					p.retailer_id,
					p.price,
					p.image,
					r.name AS retailer_name,
					p.description
				FROM
					ecommerce_test.products AS p
				INNER JOIN
					ecommerce_test.retailer AS r
				ON p.retailer_id = r.id ';

		if(is_numeric($productId)) {
			$sql .= 'WHERE p.id = ' . (int) $productId;
		}

		if(is_numeric($retailerId)) {
			$sql .= 'WHERE p.retailer_id = ' . (int) $retailerId;
		}

		if(is_numeric($productId)) {
			$rs = $this->db->query($sql);
			$result = $rs->row();
		} else if( is_null($productId) ) {
			$rs = $this->db->query($sql);
			//echo '<pre>'; var_dump($rs);
			while ($row = $rs->unbuffered_row()) {
				array_push($result, $row);
			}
		}

		return $result;
	}
}