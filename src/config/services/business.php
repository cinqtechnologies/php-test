<?php

use Ecommerce\Business\ProductBusiness;
use Ecommerce\Business\RetailerBusiness;
use Ecommerce\Business\UploadBusiness;

$container['productBusiness'] = function ($di) {
    return new ProductBusiness($di);
};

$container['retailerBusiness'] = function ($di) {
    return new RetailerBusiness($di);
};

$container['uploadBusiness'] = function ($di) {
    return new UploadBusiness($di);
};