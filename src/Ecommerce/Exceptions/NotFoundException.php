<?php

namespace Ecommerce\Exceptions;

/**
 * @author Diogo Alexsander Cavilha <diogocavilha@gmail.com>
 */
class NotFoundException extends \Exception
{
    protected $code = 404;
}
