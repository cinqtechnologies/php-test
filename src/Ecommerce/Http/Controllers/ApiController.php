<?php

namespace Ecommerce\Http\Controllers;

use Interop\Container\ContainerInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
abstract class ApiController
{
    protected $di;

    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;
    }
}
