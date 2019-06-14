<?php

declare(strict_types=1);

namespace Tests\Repositories;

use Ecommerce\Repositories\Contracts\RetailerRepositoryInterface;
use Ecommerce\Repositories\RetailerEntity;
use Ecommerce\Repositories\RetailerRepository;
use Ecommerce\Repositories\RetailerValidator;
use Ecommerce\Repositories\RepositoryAbstract;
use Interop\Container\ContainerInterface;
use Mockery as m;

class RetailerRepositoryTest extends \Tests\TestCase
{
    public function testItExtendsTheRepositoryAbstract()
    {
        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn(m::mock('\PDO'));
        $this->assertInstance(RepositoryAbstract::class, new RetailerRepository($di));
    }

    public function testItImplementsTheRepositoryInterface(): void
    {
        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn(m::mock('\PDO'));
        $this->assertInstance(RetailerRepositoryInterface::class, new RetailerRepository($di));
    }

    public function testItCanReturnARetailerById(): void
    {
        $mockResult = (object) [
            'id' => 0,
            'name' => '',
            'logo' => '',
            'description' => '',
            'website' => '',
        ];

        $expectedResult = [
            'id' => 0,
            'name' => '',
            'logo' => '',
            'description' => '',
            'website' => '',
        ];

        $stmt = m::mock('stmt');
        $stmt->shouldReceive('execute')->once()->with(['id' => 1]);
        $stmt->shouldReceive('fetch')->once()->andReturn($mockResult);

        $storage = m::mock('\PDO');
        $storage->shouldReceive('prepare')->once()->with(
            'SELECT id,
                    name,
                    logo,
                    description,
                    website
               FROM retailer
              WHERE id = :id'
        )
        ->andReturn($stmt);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);

        $repo = new RetailerRepository($di);

        $this->assertInstance(RetailerRepositoryInterface::class, $repo);
        $this->assertArraySubset($expectedResult, $repo->show(1));
    }

    public function testItCanReturnAListOfRetailers(): void
    {
        $mockResult = (object) [
            'id' => 0,
            'name' => '',
            'logo' => '',
            'description' => '',
            'website' => '',
        ];

        $expectedResult = [
            'id' => 0,
            'name' => '',
            'logo' => '',
            'description' => '',
            'website' => '',
        ];

        $stmt = m::mock('stmt');
        $stmt->shouldReceive('execute')->once();
        $stmt->shouldReceive('fetchAll')->once()->andReturn($mockResult);

        $storage = m::mock('\PDO');
        $storage->shouldReceive('prepare')->once()->with(
            'SELECT id,
                    name,
                    logo,
                    description,
                    website
               FROM retailer'
        )
        ->andReturn($stmt);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);

        $repo = new RetailerRepository($di);

        $this->assertInstance(RetailerRepositoryInterface::class, $repo);
        $this->assertArraySubset($expectedResult, $repo->showAll());
    }

    public function testItMustReturnAnEmptyArrayWhenRetailerIsNotFoundById(): void
    {
        $mockResult = [];
        $expectedResult = [];

        $stmt = m::mock('stmt');
        $stmt->shouldReceive('execute')->once()->with(['id' => 1]);
        $stmt->shouldReceive('fetch')->once()->andReturn(false);

        $storage = m::mock('\PDO');
        $storage->shouldReceive('prepare')->once()->with(
            'SELECT id,
                    name,
                    logo,
                    description,
                    website
               FROM retailer
              WHERE id = :id'
        )
        ->andReturn($stmt);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);

        $repo = new RetailerRepository($di);

        $this->assertInstance(RetailerRepositoryInterface::class, $repo);
        $this->assertEmpty($repo->show(1), 'It should return an empy array');
    }

    public function testItCanSaveARetailer(): void
    {
        $retailer = (new RetailerEntity(new RetailerValidator()))
            ->setName('Foo Bar')
            ->setLogo('logo.png')
            ->setDescription('This is a test description')
            ->setWebsite('website.com')
        ;

        $expected = [
            'name' => $retailer->getName(),
            'logo' => $retailer->getLogo(),
            'description' => $retailer->getDescription(),
            'website' => $retailer->getWebsite(),
        ];

        $stmt = m::mock('stmt');
        $stmt->shouldReceive('execute')->once()->with([
            'name' => $retailer->getName(),
            'logo' => $retailer->getLogo(),
            'description' => $retailer->getDescription(),
            'website' => $retailer->getWebsite(),
        ]);

        $storage = m::mock('\PDO');
        $storage->shouldReceive('prepare')->once()->with(
            'INSERT INTO retailer (name, logo, description, website) VALUES (:name, :logo, :description, :website)'
        )
        ->andReturn($stmt);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);

        $repo = m::mock(RetailerRepository::class, [$di])->makePartial();
        $repo->shouldReceive('getByName')->once()->with($retailer->getName())->andReturn((new RetailerEntity(new RetailerValidator())));

        $this->assertMethodExists('save', $repo);
        $this->assertArraySubset($expected, $repo->save($retailer));
    }

    public function testItMustReturnValidationMessageWhenTryingToSaveARetailerWhichAlreadyExists(): void
    {
        $retailer = (new RetailerEntity(new RetailerValidator()))
            ->setName('Foo Bar')
            ->setLogo('logo.png')
            ->setDescription('This is a test description')
            ->setWebsite('website.com')
        ;

        $expected = [
            'validation' => [
                'code' => 'record_already_exists',
                'message' => 'Record already exists: Foo Bar'
            ]
        ];

        $storage = m::mock('\PDO');

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);

        $repo = m::mock(RetailerRepository::class, [$di])->makePartial();
        $repo->shouldReceive('getByName')->once()->with($retailer->getName())->andReturn($retailer);

        $this->assertMethodExists('save', $repo);
        $this->assertArraySubset($expected, $repo->save($retailer));
    }

    public function testItCanValidateARetailerBeforeSaveIt(): void
    {
        $retailer = (new RetailerEntity(new RetailerValidator()));

        $expected = [
            'validation' => [
                'name' => ['Is required.'],
                'description' => ['Is required.'],
                'website' => ['Is required.'],
            ]
        ];

        $storage = m::mock('\PDO');
        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);

        $repo = new RetailerRepository($di);
        $this->assertMethodExists('save', $repo);
        $this->assertArraySubset($expected, $repo->save($retailer));
    }

    public function testItMustGetARetailerByName(): void
    {
        $name = 'Foobar';

        $stmt = m::mock('stmt');
        $stmt->shouldReceive('bindParam')->once()->with(':name', $name);
        $stmt->shouldReceive('execute')->once();
        $stmt->shouldReceive('fetch')->once()->andReturn((object) ['name' => 'Foobar']);

        $storage = m::mock('\PDO');
        $storage->shouldReceive('prepare')->once()->with('SELECT * FROM retailer WHERE name = :name')->andReturn($stmt);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);
        $di->shouldReceive('get')->once()->with('retailerEntity')->andReturn((new RetailerEntity(new RetailerValidator())));

        $repo = new RetailerRepository($di);

        $this->assertMethodExists('getByName', $repo);
        $repo->getByName($name);
    }

    public function testItMustGetANewInstanceOfRetailerEntityWhenGetByNameFindsNothing(): void
    {
        $name = 'Foobar';

        $stmt = m::mock('stmt');
        $stmt->shouldReceive('bindParam')->once()->with(':name', $name);
        $stmt->shouldReceive('execute')->once();
        $stmt->shouldReceive('fetch')->once()->andReturn(false);

        $storage = m::mock('\PDO');
        $storage->shouldReceive('prepare')->once()->with('SELECT * FROM retailer WHERE name = :name')->andReturn($stmt);

        $di = m::mock(ContainerInterface::class);
        $di->shouldReceive('get')->once()->with('storage')->andReturn($storage);
        $di->shouldReceive('get')->once()->with('retailerEntity')->andReturn((new RetailerEntity(new RetailerValidator())));

        $repo = new RetailerRepository($di);

        $this->assertMethodExists('getByName', $repo);

        $expected = (new RetailerEntity(new RetailerValidator()));

        $retailer = $repo->getByName($name);

        $this->assertInstance(get_class($expected), $retailer);
    }
}
