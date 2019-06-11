<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Db\Connection;

abstract class ModelBase extends Connection
{
    /**
     * ModelBase constructor.
     */
    public function __construct()
    {
        parent::getInstance();
    }
}