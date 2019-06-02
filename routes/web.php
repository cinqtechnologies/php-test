<?php
/*Products*/
Route::get('/products', "ProductsController@index")->name('products');
Route::get('/product/{id}', "ProductsController@show")->name('product');
Route::get('/product-new', "ProductsController@create")->name('product-new');
Route::get('/product-edit/{id}', "ProductsController@edit")->name('product-edit');

Route::post('/product-update/{id?}',"ProductsController@update")->name('product-update');


/*Retailers*/
Route::get('/retailers', "RetailerController@index")->name('retailers');
Route::get('/retailer/{id}', "RetailerController@show")->name('retailer');
Route::get('/retailer-new', "RetailerController@create")->name('retailer-new');
Route::get('/retailer-edit/{id}', "RetailerController@edit")->name('retailer-edit');

Route::post('/retailer-update/{id?}',"RetailerController@update")->name('retailer-update');
