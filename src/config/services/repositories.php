<?php

// use Ecommerce\Repositories\LoginsRepository;
use Ecommerce\Repositories\ProductRepository;
use Ecommerce\Repositories\RetailerRepository;

// $container['loginsRepository'] = function ($di) {
//     return new LoginsRepository($di);
// };

$container['productRepository'] = function ($di) {
    return new ProductRepository($di);
};

$container['retailerRepository'] = function ($di) {
    return new RetailerRepository($di);
};