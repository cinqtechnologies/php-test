<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

use Ecommerce\Repositories\ProductEntity;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface ProductEntityInterface
{
    public function setId(int $id): ProductEntity;
    public function getId(): int;
    public function setRetailerId(int $id): ProductEntity;
    public function getRetailerId(): int;
    public function setName(string $name): ProductEntity;
    public function getName(): string;
    public function setPrice(float $price): ProductEntity;
    public function getPrice(): float;
    public function setLogo(string $logo): ProductEntity;
    public function getLogo(): string;
    public function setDescription(string $description): ProductEntity;
    public function getDescription(): string;
    public function isUpdateAction(): bool;
}
