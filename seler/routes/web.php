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

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'orders', 'name' => 'order.'], function() {
    Route::get('/', 'OrderController@index')->name('index');
	Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
	Route::delete('/{id}', 'OrderController@destroy')->name('destroy');
    Route::get('/trashed', 'OrderController@trashed')->name('trashed');
	Route::get('/restore/{id}', 'OrderController@restore')->name('restore');
	Route::get('/cancel/{id}', 'OrderController@cancel')->name('cancel');
	Route::patch('/cancel/{id}', 'OrderController@doCancel')->name('doCancel');
	Route::post('/complete/{id}', 'OrderController@doComplete')->name('complete');
});

Route::group(['middleware' => 'auth', 'prefix' => 'shipments', 'name' => 'shipment.'], function() {
	Route::get('/', 'ShipmentController@index')->name('index');
    Route::get('/edit/{id}', 'ShipmentController@edit')->name('edit');
	Route::patch('/{id}', 'ShipmentController@update')->name('update');
});

Route::group(['middleware' => 'auth', 'prefix' => 'category', 'name' => 'category.'], function() {
    Route::get('/', 'CategoryController@index')->name('index');
    Route::get('/create', 'CategoryController@create')->name('create');
    Route::post('/', 'CategoryController@store')->name('store');
    Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
    Route::patch('/{id}', 'CategoryController@update')->name('update');
    Route::delete('/{id}', 'CategoryController@destroy')->name('destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'product', 'name' => 'product.'], function() {
    Route::get('/', 'ProductController@index')->name('index');
    Route::get('/create', 'ProductController@create')->name('create');
    Route::post('/', 'ProductController@store')->name('store');
    Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
    Route::patch('/{id}', 'ProductController@update')->name('update');
    Route::delete('/{id}', 'ProductController@destroy')->name('destroy');

    Route::get('/image/{id}', 'ProductImageController@index')->name('image.index');
    Route::get('/image/create/{id}', 'ProductImageController@create')->name('image.create');
    Route::post('/image/{id}', 'ProductImageController@store')->name('image.store');
    Route::delete('/image/{id}', 'ProductImageController@destroy')->name('image.destroy');

    Route::get('/attribute', 'AttributeController@index')->name('attribute.index');
    Route::get('/attribute/create', 'AttributeController@create')->name('attribute.create');
    Route::post('/attribute', 'AttributeController@store')->name('attribute.store');
    Route::get('/attribute/edit/{id}', 'AttributeController@edit')->name('attribute.edit');
    Route::patch('/attribute/{id}', 'AttributeController@update')->name('attribute.update');
    Route::delete('/attribute/{id}', 'AttributeController@destroy')->name('attribute.destroy');

    Route::get('/attribute/option/{id}', 'AttributeOptionController@index')->name('attribute.option.index');
    Route::post('/attribute/option/{id}', 'AttributeOptionController@store')->name('attribute.option.store');
    Route::get('/attribute/option/edit/{id}', 'AttributeOptionController@edit')->name('attribute.option.edit');
    Route::patch('/attribute/option/{id}', 'AttributeOptionController@update')->name('attribute.option.update');
    Route::delete('/attribute/option/{id}', 'AttributeOptionController@destroy')->name('attribute.option.destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'reports', 'name' => 'reports.'], function() {
    Route::get('/revenue', 'ReportController@revenue')->name('revenue');
    Route::get('/product', 'ReportController@product')->name('product');
    Route::get('/inventory', 'ReportController@inventory')->name('inventory');
    Route::get('/payment', 'ReportController@payment')->name('payment');
});


