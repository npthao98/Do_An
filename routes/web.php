<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'locale'], function() {
    Route::get('/', 'HomeController@index')->name('index');
    Auth::routes();

    Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin', 'locale']], function() {
        Route::resource('imports', 'ImportController')->only(['index', 'create', 'store']);
        Route::post('suppliers', 'ImportController@storeSupplier')->name('suppliers.store');
        Route::resource('categories', 'CategoryController')->except(['show', 'edit', 'create']);
        Route::resource('products', 'ProductController')->except('index');
        Route::get('products', 'ProductController@indexAdmin')->name('products.index');
        Route::get('orders', 'OrderController@indexAdmin')->name('orders');
        Route::resource('orders', 'OrderController')->only('update');
        Route::resource('users', 'UserController')->only(['index', 'update']);
        Route::get('/', 'HomeController@indexAdmin')->name('dashboard');
    });

    Route::get('/categories/{category}', 'ProductController@showProductByCategory')->name('product.category.index');
    Route::get('/categories', 'ProductController@index')->name('product.index');
    Route::get('/products/{product}', 'ProductController@productDetail')->name('product_detail');
    Route::get('/new-product', 'ProductController@newProduct')->name('new_product');
    Route::get('/carts', 'CartController@showCart')->name('show_cart');
    Route::post('carts/{product}','CartController@addToCart')->name('add_to_cart');
    Route::post('/carts', 'CartController@updateCart')->name('update_cart');
    Route::delete('/carts/{product_detail}', 'CartController@removeCartItem')->name('remove_cart_item');
    Route::get('/checkouts', 'OrderController@create')->name('check_out');
    Route::post('/payment', 'OrderController@payment')->name('payment')->middleware('auth');
    Route::post('/checkouts', 'OrderController@store')->name('create_order')->middleware('auth');

    Route::prefix('users')->middleware('auth')->group(function () {
        Route::get('/', 'CustomerController@index')->name('user');
        Route::put('update', 'CustomerController@update')->name('user.update');
        Route::get('change-password', 'CustomerController@viewChangePassword')->name('user.view.change.password');
        Route::put('change-password', 'CustomerController@changePassword')->name('user.change.password');
        Route::get('/orders', 'OrderController@index')->name('user.orders');
    });

    Route::post('/rates/{product}', 'RateController@createRate')->name('create.rate');
    Route::put('/rates/edit/{rate}', 'RateController@editRate')->name('edit.rate');
    Route::post('/products/search', 'ProductController@search')->name('search');
    Route::get('change-language/{language}', 'HomeController@changeLanguage')->name('user.change-language');
    Route::post('orders/cancel/{order}', 'OrderController@orderCancel')->name('orders.cancel');
});

Route::get('/districts/{city}', 'HomeController@getDistrictByCity');

