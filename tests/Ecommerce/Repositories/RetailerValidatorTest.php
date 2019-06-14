<?php

declare(strict_types=1);

namespace Tests\Repositories;

use Ecommerce\Repositories\Contracts\ValidatorInterface;
use Ecommerce\Repositories\RetailerEntity;
use Ecommerce\Repositories\RetailerValidator;
use Mockery as m;

class RetailerValidatorTest extends \Tests\TestCase
{
    public function testItImplementsTheValidatorInterface(): void
    {
        $this->assertInstance(ValidatorInterface::class, new RetailerValidator());
    }

    public function testItMustReturnValidationMessages()
    {
        $expected = [
            'validation' => [
                'name' => [
                    'Is required.'
                ],
                'description' => [
                    'Is required.',
                ],
                'website' => [
                    'Is required.'
                ]
            ]
        ];

        $retailerValidator = new RetailerValidator();
        $retailer = new RetailerEntity($retailerValidator);

        $this->assertFalse($retailerValidator->isValid($retailer));
        $this->assertArraySubset($expected, $retailerValidator->getMessages());
    }
}
