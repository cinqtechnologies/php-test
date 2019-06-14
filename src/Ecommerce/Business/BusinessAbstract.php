<?php

declare(strict_types=1);

namespace Ecommerce\Business;

use Interop\Container\ContainerInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class BusinessAbstract
{
    protected $di;

    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;
    }
}
