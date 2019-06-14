<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

use Ecommerce\Repositories\Contracts\RetailerEntityInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface RetailerRepositoryInterface
{
    public function show(int $id): array;
    public function save(RetailerEntityInterface $retailer);
    public function getByName(string $name): RetailerEntityInterface;
    public function getById(int $id): RetailerEntityInterface;
}
