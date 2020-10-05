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

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::get('orders', 'ProductController@showOrder')->name('orders');
    Route::post('orders/success/{order}', 'ProductController@orderSuccess')->name('orders.success');
    Route::post('orders/cancel/{order}', 'ProductController@orderCancel')->name('orders.cancel');
    Route::post('orders/pending/{order}', 'ProductController@orderPending')->name('orders.pending');
    Route::get('users', 'UserController@index')->name('user.index');
    Route::post('users/{user}', 'UserController@changeRole')->name('change_role');
});

Route::get('/categories/{category}', 'ProductController@showProductByCategory')->name('product.category.index');
Route::get('/categories', 'ProductController@index')->name('product.index');
Route::get('/products/{product}', 'ProductController@productDetail')->name('product_detail');
Route::get('/new-product', 'ProductController@newProduct')->name('new_product');
Route::get('/carts', 'ProductController@showCart')->name('show_cart');
Route::post('carts/{product}','ProductController@addToCart')->name('add_to_cart');
Route::post('/carts', 'ProductController@updateCart')->name('update_cart');
Route::delete('/carts/{product_detail}', 'ProductController@removeCartItem')->name('remove_cart_item');
Route::delete('/carts/', 'ProductController@removeAllCart')->name('remove_all_cart');
Route::get('/checkouts', 'ProductController@checkOut')->name('check_out');
Route::post('/checkouts', 'ProductController@createOrder')->name('create_order')->middleware('auth');

Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('user')->middleware('auth');
    Route::put('update', 'UserController@update')->name('user.update')->middleware('auth');
    Route::get('change-password', 'UserController@viewChangePassword')->name('user.view.change.password')->middleware('auth');
    Route::put('change-password', 'UserController@changePassword')->name('user.change.password')->middleware('auth');
});

Route::post('/comments/{product}', 'CommentController@createComment')->name('create.comment');
Route::put('/comments/edit/{comment}', 'CommentController@editComment')->name('edit.comment');
Route::post('/products/search', 'ProductController@search')->name('search');
