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

//Route::resource('users', 'UserController');

Route::group([
	'namespace' => 'Backend',
	'prefix' => 'admin',
], function () {
	//Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
	// Quản lý sản phẩm
	Route::group(['prefix' => 'products'], function () {
		Route::get('/', 'ProductController@index')->name('backend.product.index');
		Route::get('/create', 'ProductController@create')->name('backend.product.create');
		Route::get('/{id}', 'ProductController@show')->name('backend.product.show');
	});

	//Quản lý người dùng
	Route::group(['prefix' => 'users'], function () {
		Route::get('/', 'UserController@index')->name('backend.user.index');
		Route::get('/create', 'UserController@create')->name('backend.user.create');
		Route::get('/{id}', 'UserController@show')->name('backend.user.show');
	});

	//Quản lý danh mục sp
	Route::group(['prefix' => 'categories'], function () {
		Route::get('/', 'CategoryController@index')->name('backend.categories.index');
		Route::get('/create', 'CategoryController@create')->name('backend.categories.create');
		Route::get('/{id}', 'CategoryController@show')->name('backend.categories.show');
	});
});

Route::group([
	'namespace' => 'Fontend',
	'prefix' => 'online',
], function () {
	//Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
	Route::group(['prefix' => 'products'], function () {
		Route::get('/', 'ProductController@index')->name('fontend.product.index');
		//Route::get('/create', 'ProductController@create')->name('fontend.product.create');
	});
});
