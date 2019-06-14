<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface ValidatorAccessInterface
{
    public function isValid(): bool;
    public function getValidationMessages(): array;
}
