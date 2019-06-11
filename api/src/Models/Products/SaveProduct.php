<?php
declare(strict_types=1);

namespace App\Models;

class SaveProduct extends ModelBase
{
    /**
     * @param SaveProduct $product
     * @return bool
     */
    public static function execute(SaveProduct $product): bool
    {
        $db = parent::getConnection();

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
        $stmt = $db->prepare($query);

        $stmt->bindValue(':name', $product->name);
        $stmt->bindValue(':price', $product->price);
        $stmt->bindValue(':description', $product->description);
        $stmt->bindValue(':image', $product->image);
        $stmt->bindValue(':retailer_id', $product->retailer_id);
        $stmt->bindValue(':id', $product->id);

        return $stmt->execute();
    }
}