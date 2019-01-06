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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/products/{retailer_id?}', 'ProductController@index');
Route::get('/product', 'ProductController@create')->name('product.create');
Route::post('/product', 'ProductController@store')->name('product.store');
Route::get('/product/{id}', 'ProductController@show');
Route::post('/product/{id}/send-details', 'ProductController@sendDetails');

Route::get('/retailer/{id}', 'RetailerController@show');
Route::get('/retailer', 'RetailerController@create')->name('retailer.create');
Route::post('/retailer', 'RetailerController@store')->name('retailer.store');
