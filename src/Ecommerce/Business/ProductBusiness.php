<?php

declare(strict_types=1);

namespace Ecommerce\Business;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class ProductBusiness extends BusinessAbstract
{
    private $imagesPath = 'assets/images/products/';

    public function add(
        int $retailerId,
        string $name,
        float $price,
        array $logo,
        string $description
    ): array {
        $uploadBusiness = $this->di->get('uploadBusiness');
        $filePath = $uploadBusiness
            ->setFile($logo)
            ->setPath($this->imagesPath)
            ->upload()
        ;

        $productEntity = $this->di->get('productEntity');
        $productEntity
            ->setRetailerId($retailerId)
            ->setName($name)
            ->setPrice($price)
            ->setLogo($filePath)
            ->setDescription($description)
        ;

        return $this->di->get('productRepository')->save($productEntity);
    }

    public function update(
        int $id,
        int $retailerId,
        string $name,
        float $price,
        array $logo,
        string $description
    ): array {
        $uploadBusiness = $this->di->get('uploadBusiness');
        $filePath = $uploadBusiness
            ->setFile($logo)
            ->setPath($this->imagesPath)
            ->upload()
        ;

        $productEntity = $this->di->get('productEntity');
        $productEntity
            ->setId($id)
            ->setRetailerId($retailerId)
            ->setName($name)
            ->setPrice($price)
            ->setLogo($filePath)
            ->setDescription($description)
        ;

        return $this->di->get('productRepository')->save($productEntity);
    }

    public function delete(int $id): array
    {
        $productEntity = $this->di->get('productEntity');
        $productEntity->setId($id);

        $productRepository = $this->di->get('productRepository');
        $registeredProductEntity = $productRepository->getById($id);

        if ('' != $registeredProductEntity->getLogo()) {
            unlink($registeredProductEntity->getLogo());
        }

        return $this->di->get('productRepository')->delete($productEntity);
    }
}
