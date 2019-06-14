<?php

declare(strict_types=1);

namespace Tests;

trait AssertsTrait
{
    protected function assertFluentInterface(string $expected, $instance): void
    {
        $this->assertInstanceOf(
            $expected,
            $instance,
            sprintf('Not a fluent interface. Instance type should be %s', $expected)
        );
    }

    protected function assertInstance(string $expected, $instance): void
    {
        $this->assertInstanceOf(
            $expected,
            $instance,
            sprintf('Instance type should be %s', $expected)
        );
    }

    protected function assertClassHasConstant(string $constantName, string $namespace): void
    {
        $class = new \ReflectionClass($namespace);
        $this->assertArrayHasKey(
            $constantName,
            $class->getConstants(),
            sprintf('Class %s must have the "%s" constant defined', $namespace, $constantName)
        );
    }

    protected function assertMethodExists($methodName, $class): void
    {
        $this->assertTrue(
            method_exists($class, $methodName),
            sprintf('%s() method must exist in %s', $methodName, get_class($class))
        );
    }
}
