<?php
declare(strict_types=1);

namespace App\Models;

class RetrieveProduct extends ModelBase
{
    /**
     * @param int|null $productId
     * @return bool
     */
    public static function execute(?int $productId)
    {
        if (!is_null($productId)) {
            $query = "SELECT * FROM products WHERE id = :id";
            $stmt = self::prepare($query);
            $stmt->bindValue(':id', $productId);
        } else {
            $query = "SELECT * FROM products";
            $stmt = self::prepare($query);
        }
        $stmt->execute();

        if (!is_null($productId)) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
}