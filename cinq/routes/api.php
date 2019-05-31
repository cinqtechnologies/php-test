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


Route::get('products', 'ProductController@apiListProducts');
Route::get('products/{id}', 'ProductController@apiListProducts');
Route::get('retailer', 'RetailerController@apiListRetailer');
Route::get('retailer/{id}', 'RetailerController@apiListRetailer');


