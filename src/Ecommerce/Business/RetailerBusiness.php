<?php

declare(strict_types=1);

namespace Ecommerce\Business;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class RetailerBusiness extends BusinessAbstract
{
    private $imagesPath = 'assets/images/retailers/';

    public function add(string $name, array $logo, string $description, string $website): array
    {
        $uploadBusiness = $this->di->get('uploadBusiness');
        $filePath = $uploadBusiness
            ->setFile($logo)
            ->setPath($this->imagesPath)
            ->upload()
        ;

        $retailerEntity = $this->di->get('retailerEntity');
        $retailerEntity
            ->setName($name)
            ->setLogo($filePath)
            ->setDescription($description)
            ->setWebsite($website)
        ;

        return $this->di->get('retailerRepository')->save($retailerEntity);
    }

    public function update(int $id, string $name, array $logo, string $description, string $website): array
    {
        $uploadBusiness = $this->di->get('uploadBusiness');
        $filePath = $uploadBusiness
            ->setFile($logo)
            ->setPath($this->imagesPath)
            ->upload()
        ;

        $retailerEntity = $this->di->get('retailerEntity');
        $retailerEntity
            ->setId($id)
            ->setName($name)
            ->setLogo($filePath)
            ->setDescription($description)
            ->setWebsite($website)
        ;

        return $this->di->get('retailerRepository')->save($retailerEntity);
    }

    public function delete(int $id): array
    {
        $retailerEntity = $this->di->get('retailerEntity');
        $retailerEntity->setId($id);

        $retailerRepository = $this->di->get('retailerRepository');
        $registeredRetailerEntity = $retailerRepository->getById($id);

        if ('' != $registeredRetailerEntity->getLogo()) {
            unlink($registeredRetailerEntity->getLogo());
        }

        return $this->di->get('retailerRepository')->delete($retailerEntity);
    }
}
