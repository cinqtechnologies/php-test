<?php
declare(strict_types=1);

namespace App\Models;

class RetrieveRetailer extends ModelBase
{
    /**
     * @param int|null $id
     * @return bool
     */
    public static function execute(?int $id)
    {
        if (!is_null($id)) {
            $query = "SELECT * FROM retailers WHERE id = :id";
            $stmt = self::prepare($query);
            $stmt->bindValue(':id', $id);
        } else {
            $query = "SELECT * FROM retailers";
            $stmt = self::prepare($query);
        }
        $stmt->execute();

        if (!is_null($id)) {
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } else {
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
    }
}