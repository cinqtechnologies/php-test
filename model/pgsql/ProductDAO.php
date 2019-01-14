<?php

class ProductDAO {

    private $name;

    function list(Product $product) {
        $pdo = Conn::get_singleton_instance();
        $sql = "SELECT prod_id, name, price, retailer_id, image_url, description "
             . "FROM products "
             . "WHERE 1 = 1 ";
        if ($product->get_prod_id()) {
            $sql .= "  AND prod_id = :prod_id ";
        }
        if ($product->get_retailer()->get_retailer_id()) {
            $sql .= "  AND retailer_id = :retailer_id ";
        }
        if ($product->get_name()) {
            $sql .= "  AND UPPER(name) = UPPER(:name)";
        }
        $sql .= "ORDER BY prod_id";

        // binding...
        $stmt = $pdo->prepare($sql);
        if ($product->get_prod_id()) {
            $stmt->bindValue(':prod_id', $product->get_prod_id());
        }
        if ($product->get_retailer()->get_retailer_id()) {
            $stmt->bindValue(':retailer_id', $product->get_retailer()->get_retailer_id());
        }
        if ($product->get_name()) {
            $stmt->bindValue(':name', $product->get_name());
        }

        $stmt->execute();

        $arrObj = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $arrObj[] = $this->move_to_obj($row);
        }
        return $arrObj;
    }

    function insert(Product $product) {
        $pdo = Conn::get_singleton_instance();
        $sql = "INSERT INTO products (prod_id, name, price, retailer_id, image_url, description) "
             . "VALUES (nextval('seq_products'), :name, :price, :retailer_id, :image_url, :description) ";

        // binding...
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $product->get_name());
        $stmt->bindValue(':retailer_id', $product->get_retailer_id());
        $stmt->bindValue(':price', $product->get_price());
        $stmt->bindValue(':image_url', $product->get_image_url());
        $stmt->bindValue(':description', $product->get_description());

        try {
            $stmt->execute();
        } catch (Exception $e) {
            //ToDo: improve this...
            return 0;
        }

        return $pdo->lastInsertId('seq_products');
    }

    function move_to_obj($row) {
        $product = new product();
        $product->set_prod_id($row['prod_id']);
        $product->set_name($row['name']);
        $product->set_price($row['price']);
        $product->set_retailer_id($row['retailer_id']);
        $product->get_retailer()->set_retailer_id($row['retailer_id']);
        $product->set_image_url($row['image_url']);
        $product->set_description($row['description']);
        return $product;
    }

}

?>
