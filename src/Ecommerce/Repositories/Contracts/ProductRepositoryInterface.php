<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

use Ecommerce\Repositories\Contracts\ProductEntityInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface ProductRepositoryInterface
{
    public function show(int $id): array;
    public function save(ProductEntityInterface $product);
    public function getByName(string $name): ProductEntityInterface;
    public function getById(int $id): ProductEntityInterface;
}
