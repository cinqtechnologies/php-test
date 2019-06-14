<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use Ecommerce\Repositories\Contracts\ProductEntityInterface;
use Ecommerce\Repositories\Contracts\ProductValidatorInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class ProductValidator implements ProductValidatorInterface
{
    private $messages = [];

    public function isValid(ProductEntityInterface $product): bool
    {
        if (empty($product->getName())) {
            $this->messages['name'] = ['Is required.'];
        }

        if (empty($product->getPrice())) {
            $this->messages['price'] = ['Is required.'];
        }

        if (empty($product->getDescription())) {
            $this->messages['description'] = ['Is required.'];
        }

        return empty($this->messages);
    }

    public function getMessages(): array
    {
        return [
            'validation' => $this->messages
        ];
    }
}
