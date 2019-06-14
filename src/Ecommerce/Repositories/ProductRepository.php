<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use Ecommerce\Repositories\Contracts\ProductEntityInterface;
use Ecommerce\Repositories\Contracts\ProductRepositoryInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class ProductRepository extends RepositoryAbstract implements ProductRepositoryInterface
{
    public function show(int $id): array
    {
        $stmt = $this->storage->prepare(
            'SELECT id,
                    retailer_id,
                    name,
                    price,
                    logo,
                    description
               FROM product
              WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if (!$data) {
            return [];
        }

        return [
            'id' => (int) $data->id,
            'retailer_id' => (int) $data->retailer_id,
            'name' => $data->name,
            'price' => (float) $data->price,
            'logo' => $data->logo,
            'description' => $data->description,
        ];
    }

    public function showAll(): array
    {
        $stmt = $this->storage->prepare(
            'SELECT id,
                    retailer_id,
                    name,
                    price,
                    logo,
                    description
               FROM product'
        );
        $stmt->execute();
        $data = $stmt->fetchAll();

        if (!$data) {
            return [];
        }

        $products = [];
        foreach ($data as $product) {
            $products[] = [
                'id' => (int) $product->id,
                'retailer_id' => (int) $product->retailer_id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'logo' => $product->logo,
                'description' => $product->description,
            ];
        }

        return $products;
    }

    public function save(ProductEntityInterface $product): array
    {
        if (!$product->isValid()) {
            return $product->getValidationMessages();
        }

        $registeredProduct = $this->getByName($product->getName());
        if (!empty($registeredProduct->getName()) && $registeredProduct->getId() != $product->getId()) {
            return [
                'validation' => [
                    'code' => 'record_already_exists',
                    'message' => 'Record already exists: ' . $registeredProduct->getName()
                ]
            ];
        }

        if ($product->isUpdateAction()) {
            return $this->update($product);
        }

        $stmt = $this->storage->prepare(
            'INSERT INTO product (retailer_id, name, price, logo, description)
                  VALUES (:retailer_id, :name, :price, :logo, :description)'
        );

        $productData = [
            'retailer_id' => (int) $product->getRetailerId(),
            'name' => $product->getName(),
            'price' => (float) $product->getPrice(),
            'logo' => $product->getLogo(),
            'description' => $product->getDescription(),
        ];

        $stmt->execute($productData);

        return $productData;
    }

    public function delete(ProductEntityInterface $product): array
    {
        $registeredProduct = $this->getById($product->getId());
        if (empty($registeredProduct->getName())) {
            return [
                'validation' => [
                    'code' => 'record_does_not_exist',
                    'message' => 'Record does not exist. ID: ' . $product->getId()
                ]
            ];
        }

        $stmt = $this->storage->prepare('DELETE FROM product WHERE id = :id');

        $productData = [
            'id' => $product->getId(),
        ];

        $stmt->execute($productData);

        return $productData;
    }

    private function update(ProductEntityInterface $product): array
    {
        $productData = [
            'id' => (int) $product->getId(),
            'retailer_id' => (int) $product->getRetailerId(),
            'name' => $product->getName(),
            'price' => (float) $product->getPrice(),
            'logo' => $product->getLogo(),
            'description' => $product->getDescription(),
        ];

        $query = '
            UPDATE product
               SET retailer_id = :retailer_id,
                   name = :name,
                   price = :price,
                   logo = :logo,
                   description = :description
             WHERE id = :id
        ';

        if ('' === $product->getLogo()) {
            $query = '
                UPDATE product
                   SET retailer_id = :retailer_id,
                       name = :name,
                       price = :price,
                       description = :description
                 WHERE id = :id
            ';

            unset($productData['logo']);
        }

        $stmt = $this->storage->prepare($query);
        $stmt->execute($productData);

        return $productData;
    }

    public function getByName(string $name): ProductEntityInterface
    {
        $stmt = $this->storage->prepare('
            SELECT id,
                   retailer_id,
                   name,
                   price,
                   logo,
                   description
              FROM product
             WHERE name = :name
        ');
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $record = $stmt->fetch();
        $product = $this->di->get('productEntity');

        if (false !== $record) {
            $product
                ->setId((int) $record->id)
                ->setRetailerId((int) $record->retailer_id)
                ->setName($record->name)
                ->setPrice((float) $record->price)
                ->setLogo($record->logo)
                ->setDescription($record->description)
            ;

            return $product;
        }

        return $product;
    }

    public function getById(int $id): ProductEntityInterface
    {
        $stmt = $this->storage->prepare('
            SELECT id,
                   retailer_id,
                   name,
                   price,
                   logo,
                   description
              FROM product
             WHERE id = :id
        ');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $record = $stmt->fetch();
        $product = $this->di->get('productEntity');

        if (false !== $record) {
            $product
                ->setId((int) $record->id)
                ->setRetailerId((int) $record->retailer_id)
                ->setName($record->name)
                ->setPrice((float) $record->price)
                ->setLogo($record->logo)
                ->setDescription($record->description)
            ;

            return $product;
        }

        return $product;
    }

    public function getByRetailerId(int $id): array
    {
        $stmt = $this->storage->prepare('
            SELECT id,
                   retailer_id,
                   name,
                   price,
                   logo,
                   description
              FROM product
             WHERE retailer_id = :retailer_id
        ');
        $stmt->bindParam(':retailer_id', $id);
        $stmt->execute();
        $data = $stmt->fetchAll();

        if (!$data) {
            return [];
        }

        $products = [];
        foreach ($data as $product) {
            $products[] = [
                'id' => (int) $product->id,
                'retailer_id' => (int) $product->retailer_id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'logo' => $product->logo,
                'description' => $product->description,
            ];
        }

        return $products;
    }
}
