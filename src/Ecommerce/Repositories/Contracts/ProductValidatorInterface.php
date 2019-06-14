<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface ProductValidatorInterface extends ValidatorInterface
{
    public function isValid(ProductEntityInterface $product): bool;
}
