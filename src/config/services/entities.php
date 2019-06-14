<?php

use Ecommerce\Repositories\ProductEntity;
use Ecommerce\Repositories\ProductValidator;
use Ecommerce\Repositories\RetailerEntity;
use Ecommerce\Repositories\RetailerValidator;

$container['productEntity'] = $container->factory(function () {
    return new ProductEntity(new ProductValidator());
});

$container['retailerEntity'] = $container->factory(function () {
    return new RetailerEntity(new RetailerValidator());
});
