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
		// Route::get('/{id}', 'UserController@show')->name('backend.user.show');
		Route::post('/', 'UserController@store')->name('backend.user.store');
		Route::get('/{id}/edit', 'UserController@edit')->name('backend.user.edit');
		Route::put('/{id}update', 'UserController@update')->name('backend.user.update');
		Route::delete('/{id}delete', 'UserController@destroy')->name('backend.user.destroy');
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
	Route::group(['prefix' => 'slide'], function () {
		Route::get('/', 'SlideController@index')->name('backend.slide.index');
		Route::get('/create', 'SlideController@create')->name('backend.slide.create');
		Route::post('/', 'SlideController@store')->name('backend.slide.store');
		Route::get('/{id}', 'SlideController@show')->name('backend.slide.show');
		Route::delete('/{id}/delete', 'SlideController@destroy')->name('backend.slide.destroy');
	});
});
// Route::get('add/{id}', 'Fontend\CartController@add');
Route::prefix('user')->namespace('Fontend')->group(function () {
	Route::get('/index', 'ProductController@index')->name('fontend.index');
	//Route::get('/cart', 'ProductController@cart')->name('fontend.product.cart');
	//Route::get('/contact', 'ProductController@contact')->name('fontend.product.contact');
	Route::get('/product/{slug}', 'ProductController@product')->name('fontend.product.product');
	//Route::get('/shop', 'ProductController@shop')->name('fontend.product.shop');
	Route::group(['prefix' => 'cart'], function () {
		Route::get('/', 'CartController@index')->name('fontend.cart.index');
		Route::get('add/{id}', 'CartController@add')->name('fontend.cart.add');
	});

	Route::group(['prefix' => 'shop'], function () {
		Route::get('/', 'ShopController@index')->name('fontend.shop.index');
	});

	Route::group(['prefix' => 'contact'], function () {
		Route::get('/', 'ContactController@index')->name('fontend.contact.index');
	});
	Route::group(['prefix' => 'category'], function () {
		Route::get('/{id}', 'ProductController@category')->name('fontend.category.index');
	});

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('getCache', 'HomeController@getCache');
Route::get('set', 'SessionController@set');
Route::get('get', 'SessionController@get');
Route::get('get2', 'SessionController@get2');
Route::get('setCookie', 'CookieController@set');
Route::get('getCookie', 'CookieController@get');
Route::get('logout', 'LoginController@logout');
Route::prefix('logout')->namespace('Auth')->group(function () {
	Route::get('/', 'LoginController@logout')->name('logout');

});
