<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', function () {
    return view('welcome');
});

Route::prefix('product')->group(function () {
    Route::get('index', 'ProductController@index')->name('prod.index');
    Route::get('new', 'ProductController@create')->name('prod.new');
    Route::post('save', 'ProductController@store')->name('prod.save');
    Route::get('editScreen/{id}', 'ProductController@edit')->name('prod.editScreen');
    Route::any('persistEdit/{id}', 'ProductController@update')->name('prod.persistEdit');
    Route::get('delete/{id}', 'ProductController@destroy')->name('prod.delete');
});

Route::prefix('retailer')->group(function () {
    Route::get('index', 'RetailerController@index')->name('retail.index');
    Route::get('new', 'RetailerController@create')->name('retail.new');
    Route::post('save', 'RetailerController@store')->name('retail.save');
    Route::get('editScreen/{id}', 'RetailerController@edit')->name('retail.editScreen');
    Route::any('persistEdit/{id}', 'RetailerController@update')->name('retail.persistEdit');
    Route::get('delete/{id}', 'RetailerController@destroy')->name('retail.delete');
});
    

Route::prefix('storeView')->group(function () {
    Route::get('index', 'storeViewController@index')->name('store.index');
    Route::get('indexSelectedRetailer/{id}', 'storeViewController@indexWithRetailer')->name('store.indexWithRetailer');
    Route::get('productDetail/{idProduct}', 'storeViewController@productDetail')->name('store.productDetail');
    Route::any('fakemail/{idProduct}', 'storeViewController@fakemail')->name('store.fakemail');
    /* Route::get('new', 'ProductController@create')->name('prod.new');
    Route::post('save', 'ProductController@store')->name('prod.save');
    Route::get('editScreen/{id}', 'ProductController@edit')->name('prod.editScreen');
    Route::any('persistEdit/{id}', 'ProductController@update')->name('prod.persistEdit');
    Route::get('delete/{id}', 'ProductController@destroy')->name('prod.delete'); */
});

Route::get('/testeRetailerView', function () {
    return view('storeviews.indexRetailer');
});