<?php

use Ecommerce\Http\Controllers\ProductController;

$app->post('/products', ProductController::class . ':create');
$app->put('/products/{id:\d+}', ProductController::class . ':update');
$app->get('/products/{id:\d+}', ProductController::class . ':show');
$app->delete('/products/{id:\d+}', ProductController::class . ':delete');
$app->get('/products', ProductController::class . ':showAll');
