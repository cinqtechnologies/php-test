<?php
declare(strict_types=1);

namespace App\Models;

class DeleteRetailer extends ModelBase
{
    /**
     * @param int $id
     * @return bool
     */
    public static function execute(int $id): bool
    {
        $query = "
            DELETE FROM retailers WHERE id = :id
        ";
        $stmt = self::prepare($query);

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }
}