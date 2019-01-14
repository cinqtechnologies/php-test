<?php

class RetailerDAO {

    private $name;

    function list(Retailer $retailer) {
        $pdo = Conn::get_singleton_instance();
        $sql = "SELECT retailer_id, name, logo_url, url, description "
             . "FROM retailers "
             . "WHERE 1 = 1 ";
        if ($retailer->get_retailer_id()) {
            $sql .= "  AND retailer_id = :retailer_id ";
        }
        if ($retailer->get_name()) {
            $sql .= "  AND UPPER(name) = UPPER(:name)";
        }
        $sql .= "ORDER BY retailer_id";

        // binding...
        $stmt = $pdo->prepare($sql);
        if ($retailer->get_retailer_id()) {
            $stmt->bindValue(':retailer_id', $retailer->get_retailer_id());
        }
        if ($retailer->get_name()) {
            $stmt->bindValue(':name', $retailer->get_name());
        }

        $stmt->execute();

        $arrObj = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $arrObj[] = $this->move_to_obj($row);
        }
        return $arrObj;
    }

    function insert(Retailer $retailer) {
        $pdo = Conn::get_singleton_instance();
        $sql = "INSERT INTO retailers (retailer_id, name, logo_url, url, description) "
             . "VALUES (nextval('seq_retailers'), :name, :logo_url, :url, :description) ";

        // binding...
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $retailer->get_name());
        $stmt->bindValue(':logo_url', $retailer->get_logo_url());
        $stmt->bindValue(':url', $retailer->get_url());
        $stmt->bindValue(':description', $retailer->get_description());

        try {
            $stmt->execute();
        } catch (Exception $e) {
            //ToDo: improve this...
            return 0;
        }

        return $pdo->lastInsertId('seq_retailers');
    }

    function move_to_obj($row) {
        $retailer = new Retailer();
        $retailer->set_retailer_id($row['retailer_id']);
        $retailer->set_name($row['name']);
        $retailer->set_logo_url($row['logo_url']);
        $retailer->set_url($row['url']);
        $retailer->set_description($row['description']);
        return $retailer;
    }
}

?>
