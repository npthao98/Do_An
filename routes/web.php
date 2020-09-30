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
Route::get('/', 'HomeController@index')->name('index');

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
});

Route::get('/categories/{category}', 'ProductController@showProductByCategory')->name('product.category.index');
Route::get('/categories', 'ProductController@index')->name('product.index');
Route::get('/products/{product}', 'ProductController@productDetail')->name('product_detail');
Route::get('/carts', 'ProductController@showCart')->name('show_cart');
Route::post('carts/{product}','ProductController@addToCart')->name('add_to_cart');
Route::post('/carts', 'ProductController@updateCart')->name('update_cart');
Route::delete('/carts/{product_detail}', 'ProductController@removeCartItem')->name('remove_cart_item');
Route::delete('/carts/', 'ProductController@removeAllCart')->name('remove_all_cart');
Route::get('/checkouts', 'ProductController@checkOut')->name('check_out');
Route::post('/checkouts', 'ProductController@createOrder')->name('create_order')->middleware('auth');
