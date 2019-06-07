<?php

use App\Controllers\ProductController;

$app->post('/product', ProductController::class . ':create');
$app->get('/product', ProductController::class . ':retrieve');
$app->put('/product', ProductController::class . ':update');
$app->delete('/product/{id}', ProductController::class . ':delete');

$app->post('/retailer', RetailerController::class . ':create');
$app->get('/retailer/{:id}', RetailerController::class . ':retrieve');
$app->put('/retailer', RetailerController::class . ':update');
$app->delete('/retailer/id', RetailerController::class . ':delete');