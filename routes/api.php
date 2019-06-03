<?php
Route::put('/v1/product/new', "APIv1Controller@product_new");
Route::post('/v1/product/{id}/edit', "APIv1Controller@product_edit");
Route::get('/v1/product/{id}', "APIv1Controller@product");
Route::get('/v1/products', "APIv1Controller@products");

Route::put('/v1/retailer/new', "APIv1Controller@retailer_new");
Route::post('/v1/retailer/{id}/edit', "APIv1Controller@retailer_edit");
Route::get('/v1/retailer/{id}', "APIv1Controller@retailer");
Route::get('/v1/retailer/{id}/products', "APIv1Controller@retailer_products");
Route::get('/v1/retailers', "APIv1Controller@retailers");
