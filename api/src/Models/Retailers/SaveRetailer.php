<?php
declare(strict_types=1);

namespace App\Models;

class SaveRetailer extends ModelBase
{
    /**
     * @param Retailer $retailer
     * @return bool
     */
    public static function execute(Retailer $retailer): bool
    {
        $query = "
            INSERT INTO retailers (
                id,
                description,
                logo,
                website
            ) VALUES (
                :id,
                :description, 
                :logo, 
                :website
            ) ON DUPLICATE KEY UPDATE 
                description = :description, 
                logo = :logo, 
                website = :website 
        ";
        $stmt = self::prepare($query);

        $stmt->bindValue(':logo', $retailer->getLogo());
        $stmt->bindValue(':description', $retailer->getDescription());
        $stmt->bindValue(':website', $retailer->getWebsite());
        $stmt->bindValue(':id', $retailer->getId());

        return $stmt->execute();
    }
}