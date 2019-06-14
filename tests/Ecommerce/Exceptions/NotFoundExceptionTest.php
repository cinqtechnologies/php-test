<?php

declare(strict_types=1);

namespace Tests\Exceptions;

use Ecommerce\Exceptions\NotFoundException;

class NotFoundExceptionTest extends \Tests\TestCase
{
    public function testItMustHaveTheCorrectErrorCode()
    {
        $expected = 404;
        $exception = new NotFoundException();
        $this->assertSame(
            $expected,
            $exception->getCode(),
            'It must have error code ' . $expected
        );
    }
}
