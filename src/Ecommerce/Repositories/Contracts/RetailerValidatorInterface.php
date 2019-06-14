<?php

declare(strict_types=1);

namespace Ecommerce\Repositories\Contracts;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
interface RetailerValidatorInterface extends ValidatorInterface
{
    public function isValid(RetailerEntityInterface $retailer): bool;
}
