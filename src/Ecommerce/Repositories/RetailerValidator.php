<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use Ecommerce\Repositories\Contracts\RetailerEntityInterface;
use Ecommerce\Repositories\Contracts\RetailerValidatorInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class RetailerValidator implements RetailerValidatorInterface
{
    private $messages = [];

    public function isValid(RetailerEntityInterface $retailer): bool
    {
        if (empty($retailer->getName())) {
            $this->messages['name'] = ['Is required.'];
        }

        if (empty($retailer->getDescription())) {
            $this->messages['description'] = ['Is required.'];
        }

        if (empty($retailer->getWebsite())) {
            $this->messages['website'] = ['Is required.'];
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
