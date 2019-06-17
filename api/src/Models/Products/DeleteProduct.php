<?php
declare(strict_types=1);

namespace App\Models;

class DeleteProduct extends ModelBase
{
    /**
     * @param int $productId
     * @return bool
     */
    public static function execute(int $productId): bool
    {
        $query = "
            DELETE FROM products WHERE id = :id
        ";
        $stmt = self::prepare($query);

        $stmt->bindValue(':id', $productId);

        return $stmt->execute();
    }
}