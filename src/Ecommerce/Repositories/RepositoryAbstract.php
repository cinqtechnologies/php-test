<?php

declare(strict_types=1);

namespace Ecommerce\Repositories;

use \PDO as Storage;
use Interop\Container\ContainerInterface;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
abstract class RepositoryAbstract
{
    protected $storage;

    public function __construct(ContainerInterface $di)
    {
        $this->di = $di;
        $this->storage = $di->get('storage');
    }
}
