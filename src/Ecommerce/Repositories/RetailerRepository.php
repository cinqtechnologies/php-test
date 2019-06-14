<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use Ecommerce\Repositories\Contracts\RetailerEntityInterface;
use Ecommerce\Repositories\Contracts\RetailerRepositoryInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class RetailerRepository extends RepositoryAbstract implements RetailerRepositoryInterface
{
    public function show(int $id): array
    {
        $stmt = $this->storage->prepare(
            'SELECT id,
                    name,
                    logo,
                    description,
                    website
               FROM retailer
              WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if (!$data) {
            return [];
        }

        return [
            'id' => (int) $data->id,
            'name' => $data->name,
            'logo' => $data->logo,
            'description' => $data->description,
            'website' => $data->website,
        ];
    }

    public function showAll(): array
    {
        $stmt = $this->storage->prepare(
            'SELECT id,
                    name,
                    logo,
                    description,
                    website
               FROM retailer'
        );
        $stmt->execute();
        $data = $stmt->fetchAll();

        if (!$data) {
            return [];
        }

        $retailers = [];
        foreach ($data as $retailer) {
            $retailers[] = [
                'id' => (int) $retailer->id,
                'name' => $retailer->name,
                'logo' => $retailer->logo,
                'description' => $retailer->description,
                'website' => $retailer->website,
            ];
        }

        return $retailers;
    }

    public function save(RetailerEntityInterface $retailer): array
    {
        if (!$retailer->isValid()) {
            return $retailer->getValidationMessages();
        }

        $registeredRetailer = $this->getByName($retailer->getName());
        if (!empty($registeredRetailer->getName()) && $registeredRetailer->getId() != $retailer->getId()) {
            return [
                'validation' => [
                    'code' => 'record_already_exists',
                    'message' => 'Record already exists: ' . $registeredRetailer->getName()
                ]
            ];
        }

        if ($retailer->isUpdateAction()) {
            return $this->update($retailer);
        }

        $stmt = $this->storage->prepare(
            'INSERT INTO retailer (name, logo, description, website) VALUES (:name, :logo, :description, :website)'
        );

        $retailerData = [
            'name' => $retailer->getName(),
            'logo' => $retailer->getLogo(),
            'description' => $retailer->getDescription(),
            'website' => $retailer->getWebsite(),
        ];

        $stmt->execute($retailerData);

        return $retailerData;
    }

    public function delete(RetailerEntityInterface $retailer): array
    {
        $registeredRetailer = $this->getById($retailer->getId());
        if (empty($registeredRetailer->getName())) {
            return [
                'validation' => [
                    'code' => 'record_does_not_exist',
                    'message' => 'Record does not exist. ID: ' . $retailer->getId()
                ]
            ];
        }

        $stmt = $this->storage->prepare('DELETE FROM retailer WHERE id = :id');

        $retailerData = [
            'id' => $retailer->getId(),
        ];

        $stmt->execute($retailerData);

        return $retailerData;
    }

    private function update(RetailerEntityInterface $retailer): array
    {
        $retailerData = [
            'name' => $retailer->getName(),
            'logo' => $retailer->getLogo(),
            'description' => $retailer->getDescription(),
            'website' => $retailer->getWebsite(),
            'id' => $retailer->getId(),
        ];

        $query = '
            UPDATE retailer
               SET name = :name,
                   logo = :logo,
                   description = :description,
                   website = :website
             WHERE id = :id
        ';

        if ('' === $retailer->getLogo()) {
            $query = '
                UPDATE retailer
                   SET name = :name,
                       description = :description,
                       website = :website
                 WHERE id = :id
            ';

            unset($retailerData['logo']);
        }

        $stmt = $this->storage->prepare($query);
        $stmt->execute($retailerData);

        return $retailerData;
    }

    public function getByName(string $name): RetailerEntityInterface
    {
        $stmt = $this->storage->prepare('SELECT id, name, logo, description, website FROM retailer WHERE name = :name');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $record = $stmt->fetch();
        $retailer = $this->di->get('retailerEntity');

        if (false !== $record) {
            $retailer
                ->setId((int) $record->id)
                ->setName($record->name)
                ->setLogo($record->logo)
                ->setDescription($record->description)
                ->setWebsite($record->website)
            ;

            return $retailer;
        }

        return $retailer;
    }

    public function getById(int $id): RetailerEntityInterface
    {
        $stmt = $this->storage->prepare('SELECT id, name, logo, description, website FROM retailer WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $record = $stmt->fetch();
        $retailer = $this->di->get('retailerEntity');

        if (false !== $record) {
            $retailer
                ->setId((int) $record->id)
                ->setName($record->name)
                ->setLogo($record->logo)
                ->setDescription($record->description)
                ->setWebsite($record->website)
            ;

            return $retailer;
        }

        return $retailer;
    }
}
