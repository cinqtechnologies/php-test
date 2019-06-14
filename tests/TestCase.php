<?php

namespace Tests;

use Mockery as m;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    use AssertsTrait;

    public function tearDown()
    {
        if ($container = m::getContainer()) {
            $this->addToAssertionCount($container->mockery_getExpectationCount());
        }

        m::close();
    }
}
