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

Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Products', 'prefix' => 'product', 'name' => 'product.'], function() {
    Route::get('/', 'ProductController@index')->name('index');
    Route::get('/{slug}', 'ProductController@show')->name('show');
    Route::get('/quick-view/{slug}', 'ProductViewController@show')->name('view.show');
});

Route::group(['namespace' => 'Carts', 'prefix' => 'carts', 'name' => 'cart.'], function() {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('/', 'CartController@store')->name('store');
    Route::patch('/', 'CartController@update')->name('update');
    Route::get('/delete/{card}', 'CartController@destroy')->name('destroy');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Orders', 'prefix' => 'orders', 'name' => 'order.'], function() {
    Route::get('/checkout', 'OrderController@checkout')->name('checkout');
    Route::post('/checkout', 'OrderController@doCheckout')->name('store');
    Route::post('/shipping-cost', 'OrderController@shippingCost')->name('shipping.cost');
    Route::post('/set-shipping', 'OrderController@setShipping')->name('shipping.set');
    // Route::get('/complete', 'OrderController@complete');
    // Route::get('/invoice', 'OrderController@invoice');
    Route::get('/received/{orderID}', 'OrderController@received')->name('received');
    Route::get('/cities', 'OrderController@cities')->name('cities');
});

Route::group(['namespace' => 'Payments', 'prefix' => 'payments', 'name' => 'payment.'], function() {
    Route::post('/notification', 'PaymentController@notification')->name('notification');
    Route::get('/completed', 'PaymentController@completed')->name('completed');
    Route::get('/failed', 'PaymentController@failed')->name('failed');
    Route::get('/unfinish', 'PaymentController@unfinish')->name('unfinish');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Favorites', 'prefix' => 'favorites', 'name' => 'favorite.'], function() {
    Route::get('/', 'FavoriteController@index')->name('index');
    Route::post('/', 'FavoriteController@store')->name('store');
    Route::delete('/{id}', 'FavoriteController@destroy')->name('destroy');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Users', 'prefix' => 'user', 'name' => 'user.'], function() {
    Route::get('/', 'UserController@index')->name('index');
    Route::post('/', 'UserController@update')->name('update');

    Route::get('/orders', 'UserOrderController@index')->name('index');
    Route::get('/orders/{id}', 'UserOrderController@show')->name('show');
});

Auth::routes();


