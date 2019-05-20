<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* PRODUCT API ROUTES */

Route::get('/product', 'ProductApiController@index')->name('product.all');

Route::post('/product', 'ProductApiController@store')->name('product.store');

Route::get('/product/{product}', 'ProductApiController@show')->name('product.show');

Route::get('/productdetail/{idproduto}', 'ProductApiController@productDetail')->name('product.productDetail');

Route::any('/product/{product}', 'ProductApiController@update')->name('product.update');

Route::delete('/product/{product}', 'ProductApiController@destroy')->name('product.destroy');

/* RETAILERS API ROUTES */

Route::get('/retailer', 'RetailerApiController@index')->name('product.all');

Route::post('/retailer', 'RetailerApiController@store')->name('product.store');

Route::get('/retailer/{retailer}', 'RetailerApiController@show')->name('product.show');

Route::get('/retailerdetail/{idretailer}', 'RetailerApiController@productDetail')->name('product.productDetail');

Route::any('/retailer/{retailer}', 'RetailerApiController@update')->name('product.update');

Route::delete('/retailer/{retailer}', 'RetailerApiController@destroy')->name('product.destroy');