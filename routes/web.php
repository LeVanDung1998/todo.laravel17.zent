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

Route::get('', function () {
	return view('welcome');
});

Route::group([
	'namespace' => 'Backend',
	'prefix' => 'admin',
	'middleware' => 'auth',
], function () {
	Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
	// Quản lý sản phẩm
	Route::group(['prefix' => 'products'], function () {
		Route::get('/', 'ProductController@index')->name('backend.product.index');
		Route::get('/create', 'ProductController@create')->name('backend.product.create');
		Route::get('/{id}', 'ProductController@show')->name('backend.product.show');
		Route::post('/', 'ProductController@store')->name('backend.product.store');
		Route::get('/{id}/edit', 'ProductController@edit')->name('backend.product.edit');
		Route::put('/{id}/update', 'ProductController@update')->name('backend.product.update');
		Route::delete('/{id}/delete', 'ProductController@destroy')->name('backend.product.destroy');
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
		//Route::get('/{id}', 'CategoryController@show')->name('backend.categories.show');
		Route::post('/', 'CategoryController@store')->name('backend.categories.store');
		Route::get('/{id}/edit', 'CategoryController@edit')->name('backend.categories.edit');
		Route::put('/{id}/update', 'CategoryController@update')->name('backend.categories.update');
		Route::delete('/{id}/delete', 'CategoryController@destroy')->name('backend.categories.destroy');
	});
});

Route::group([
	'namespace' => 'Frontend',
	'prefix' => 'online',
], function () {
	Route::get('/', 'IndexController@index')->name('frontend.index');
	Route::group(['prefix' => 'products'], function () {
		Route::get('/', 'ProductController@index')->name('frontend.product.index');
	});
	Route::group(['prefix' => 'shop'], function () {
		Route::get('/', 'ShopController@index')->name('frontend.shop.index');
	});
	//Quản lý danh mục sản phẩm
	Route::group(['prefix' => 'cart'], function () {
		Route::get('/', 'CartController@index')->name('frontend.cart.index');
	});
	Route::group(['prefix' => 'contact'], function () {
		Route::get('/', 'ContactController@index')->name('contact.index');
	});
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
