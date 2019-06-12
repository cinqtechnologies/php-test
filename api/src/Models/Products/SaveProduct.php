<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Db\Connection;

class SaveProduct extends ModelBase
{
    /**
     * @param Product $product
     * @return bool
     */
    public static function execute(Product $product): bool
    {
        //$db = self::getInstance();
        //$db = Connection::getInstance();

        $query = "
            INSERT INTO products (
                id, 
                `name`, 
                price, 
                image, 
                description, 
                retailer_id
            ) VALUES (
                :id,
                :name, 
                :price, 
                :image, 
                :description, 
                :retailer_id
            ) ON DUPLICATE KEY UPDATE 
                `name` = :name, 
                price = :price, 
                image = :image, 
                description = :description, 
                retailer_id = :retailer_id
        ";
        $stmt = self::prepare($query);

        $stmt->bindValue(':name', $product->getName());
        $stmt->bindValue(':price', $product->getPrice());
        $stmt->bindValue(':description', $product->getDescription());
        $stmt->bindValue(':image', $product->getImage());
        $stmt->bindValue(':retailer_id', $product->getRetailerId());
        $stmt->bindValue(':id', $product->getId());

        return $stmt->execute();
    }
}