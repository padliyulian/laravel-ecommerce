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

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'name' => 'user.'], function() {
    Route::get('/', 'UserController@index')->name('index');
    Route::get('/create', 'UserController@create')->name('create');
    Route::post('/', 'UserController@store')->name('store');
    Route::get('/edit/{id}', 'UserController@edit')->name('edit');
    Route::patch('/{id}', 'UserController@update')->name('update');
    Route::delete('/{id}', 'UserController@destroy')->name('destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'role', 'name' => 'role.'], function() {
    Route::get('/', 'RoleController@index')->name('index');
    Route::get('/create', 'RoleController@create')->name('create');
    Route::post('/', 'RoleController@store')->name('store');
    Route::patch('/{id}', 'RoleController@update')->name('update');
    // Route::delete('/{id}', 'RoleController@destroy')->name('destroy');
});

Route::group(['middleware' => 'auth', 'prefix' => 'slides', 'name' => 'slides.'], function() {
    Route::get('/', 'SlideController@index')->name('index');
    Route::get('/create', 'SlideController@create')->name('create');
    Route::post('/', 'SlideController@store')->name('store');
    Route::get('/edit/{id}', 'SlideController@edit')->name('edit');
    Route::patch('/{id}', 'SlideController@update')->name('update');
    Route::delete('/{id}', 'SlideController@destroy')->name('destroy');
	Route::get('/up/{id}', 'SlideController@moveUp')->name('moveUp');;
	Route::get('/down/{id}', 'SlideController@moveDown')->name('moveDown');;
});



