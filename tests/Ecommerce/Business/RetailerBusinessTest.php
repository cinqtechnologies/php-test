<?php

declare(strict_types=1);

namespace Tests\Business;

use Ecommerce\Business\BusinessAbstract;
use Ecommerce\Business\RetailerBusiness;
use Ecommerce\Repositories\RetailerEntity;
use Ecommerce\Repositories\RetailerRepository;
use Ecommerce\Repositories\RetailerValidator;
use Interop\Container\ContainerInterface;
use Mockery as m;

class RetailerBusinessTest extends \Tests\TestCase
{
    public function testItMustExtendsTheBusinessAbstract(): void
    {
        $di = m::mock(ContainerInterface::class);
        $retailerBusiness = new RetailerBusiness($di);
        $this->assertInstance(BusinessAbstract::class, $retailerBusiness);
    }

    public function testItMustCreateARetailer(): void
    {
        $name = 'Foo Bar';
        $logo = [''];
        $description = 'description';
        $website = 'website.com';

        $retailerEntity = new RetailerEntity(new RetailerValidator());

        $retailerRepository = m::mock(RetailerRepository::class);
        $retailerRepository->shouldReceive('save')->once()->with($retailerEntity)->andReturn([]);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('retailerEntity')->andReturn($retailerEntity);
        $di->shouldReceive('get')->once()->with('retailerRepository')->andReturn($retailerRepository);

        $retailerBusiness = new RetailerBusiness($di);

        $this->assertMethodExists('add', $retailerBusiness);
        $this->assertArraySubset([], $retailerBusiness->add($name, $logo, $description, $website));
    }
}
