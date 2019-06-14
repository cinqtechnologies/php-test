<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface ValidatorInterface
{
    public function getMessages(): array;
}
