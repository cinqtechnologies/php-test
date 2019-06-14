<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

use Ecommerce\Repositories\RetailerEntity;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface RetailerEntityInterface
{
    public function setId(int $id): RetailerEntity;
    public function getId(): int;
    public function setName(string $name): RetailerEntity;
    public function getName(): string;
    public function setLogo(string $logo): RetailerEntity;
    public function getLogo(): string;
    public function setDescription(string $description): RetailerEntity;
    public function getDescription(): string;
    public function isUpdateAction(): bool;
}
