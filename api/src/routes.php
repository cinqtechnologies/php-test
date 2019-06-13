<?php

use App\Controllers\ProductController;
use App\Controllers\RetailerController;

$app->post('/product', ProductController::class . ':create');
$app->get('/product[/{id}]', ProductController::class . ':retrieve');
$app->patch('/product', ProductController::class . ':update');
$app->delete('/product[/{id}]', ProductController::class . ':delete');

$app->post('/retailer', RetailerController::class . ':create');
$app->get('/retailer[/{id}]', RetailerController::class . ':retrieve');
$app->patch('/retailer', RetailerController::class . ':update');
$app->delete('/retailer/{id}', RetailerController::class . ':delete');