<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use Ecommerce\Repositories\Contracts\ProductEntityInterface;
use Ecommerce\Repositories\Contracts\ProductValidatorInterface;
use Ecommerce\Repositories\Contracts\ValidatorAccessInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class ProductEntity implements ProductEntityInterface, ValidatorAccessInterface
{
    private $id;
    private $retailerId;
    private $name;
    private $price;
    private $logo;
    private $description;
    private $validator;

    public function __construct(ProductValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function setId(int $id): ProductEntity
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return (int) $this->id;
    }

    public function setRetailerId(int $id): ProductEntity
    {
        $this->retailerId = $id;
        return $this;
    }

    public function getRetailerId(): int
    {
        return (int) $this->retailerId;
    }

    public function setName(string $name): ProductEntity
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): string
    {
        return (string) $this->name;
    }

    public function setPrice(float $price): ProductEntity
    {
        $this->price = $price;
        return $this;
    }

    public function getPrice(): float
    {
        return (float) $this->price;
    }

    public function setLogo(string $logo): ProductEntity
    {
        $this->logo = $logo;
        return $this;
    }

    public function getLogo(): string
    {
        return (string) $this->logo;
    }

    public function setDescription(string $description): ProductEntity
    {
        $this->description = $description;
        return $this;
    }

    public function getDescription(): string
    {
        return (string) $this->description;
    }

    public function isValid(): bool
    {
        return $this->validator->isValid($this);
    }

    public function getValidationMessages(): array
    {
        return $this->validator->getMessages();
    }

    public function isUpdateAction(): bool
    {
        return $this->id > 0;
    }
}
