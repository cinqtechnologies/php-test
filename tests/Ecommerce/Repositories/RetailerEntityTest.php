<?php

declare(strict_types=1);

namespace Tests\Repositories;

use Ecommerce\Repositories\Contracts\RetailerEntityInterface;
use Ecommerce\Repositories\EntityAbstract;
use Ecommerce\Repositories\RetailerEntity;
use Ecommerce\Repositories\RetailerValidator;

class RetailerEntityTest extends \Tests\TestCase
{
    public function testItMustImplementTheEntityInterface()
    {
        $retailerEntity = new RetailerEntity(new RetailerValidator());
        $this->assertInstance(RetailerEntityInterface::class, $retailerEntity);
    }

    public function testItMustSetAndGetTheName(): void
    {
        $expected = 'Foo Bar';

        $retailerEntity = new RetailerEntity(new RetailerValidator());

        $this->assertMethodExists('setName', $retailerEntity);
        $this->assertMethodExists('getName', $retailerEntity);
        $this->assertInstance(RetailerEntity::class, $retailerEntity->setName($expected));
        $this->assertEquals($expected, $retailerEntity->getName());
    }

    public function testItMustSetAndGetTheLogo(): void
    {
        $expected = 'logo.png';

        $retailerEntity = new RetailerEntity(new RetailerValidator());

        $this->assertMethodExists('setLogo', $retailerEntity);
        $this->assertMethodExists('getLogo', $retailerEntity);
        $this->assertInstance(RetailerEntity::class, $retailerEntity->setLogo($expected));
        $this->assertEquals($expected, $retailerEntity->getLogo());
    }

    public function testItMustSetAndGetTheDescription(): void
    {
        $expected = 'This is a description';

        $retailerEntity = new RetailerEntity(new RetailerValidator());

        $this->assertMethodExists('setDescription', $retailerEntity);
        $this->assertMethodExists('getDescription', $retailerEntity);
        $this->assertInstance(RetailerEntity::class, $retailerEntity->setDescription($expected));
        $this->assertEquals($expected, $retailerEntity->getDescription());
    }
}
