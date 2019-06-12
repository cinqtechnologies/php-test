<?php
declare(strict_types=1);

namespace App\Models;

class RetrieveProduct extends ModelBase
{
    /**
     * @param int|null $productId
     * @return bool
     */
    public static function execute(int $productId = null): bool
    {
        $query = "
            SELECT * FROM products WHERE id = :id
        ";
        $stmt = self::prepare($query);

        if (!is_null($productId)) {
            $stmt->bindValue(':id', $productId);
        }

        return $stmt->execute();
    }
}