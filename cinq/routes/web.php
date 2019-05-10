<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'ProductController@index');
Route::get('/products', 'ProductController@products')->name('products');
Route::get('/product/{id}', 'ProductController@show')->name('product.show');
Route::get('/retailer/{id}', 'RetailerController@show')->name('retailer.show');
Route::get('/retailer-products-list/{id}', 'ProductController@retailerProducts')->name('retailer.products');
Route::get('/createproduct', 'ProductController@new');
Route::get('/createretailer', 'RetailerController@new');
Route::post('/createproduct', 'ProductController@save');
Route::post('/createretailer', 'RetailerController@save');
Route::post('/tellme', 'ProductController@tellMeWhenAvailable');

