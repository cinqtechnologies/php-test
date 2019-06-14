<?php

use Ecommerce\Http\Controllers\RetailerController;

$app->post('/retailers', RetailerController::class . ':create');
$app->put('/retailers/{id:\d+}', RetailerController::class . ':update');
$app->get('/retailers/{id:\d+}', RetailerController::class . ':show');
$app->get('/retailers/{id:\d+}/products', RetailerController::class . ':showAllProducts');
$app->delete('/retailers/{id:\d+}', RetailerController::class . ':delete');
$app->get('/retailers', RetailerController::class . ':showAll');
