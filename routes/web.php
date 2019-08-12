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

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
	Route::get('/brands', 'BrandController@index')->name('admin.brand.index');
	Route::get('/brands/create', 'BrandController@create')->name('admin.brand.create');
	Route::post('/brands/{brand}', 'BrandController@update')->name('admin.brand.update');
	Route::get('/brands/{brand}/edit', 'BrandController@edit')->name('admin.brand.edit');
	Route::post('/brands', 'BrandController@store')->name('admin.brand.store');
	Route::delete('/brands/{brand}', 'BrandController@destroy')->name('admin.brand.destroy');

	Route::get('/categories', 'CategoryController@index')->name('admin.category.index');
	Route::get('/categories/create', 'CategoryController@create')->name('admin.category.create');
	Route::post('categories/{category}', 'CategoryController@update')->name('admin.category.update');
	Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('admin.category.edit');
	Route::post('/categories', 'CategoryController@store')->name('admin.category.store');
	Route::delete('/categories/{category}', 'CategoryController@destroy')->name('admin.category.destroy');

    Route::get('/posts', 'PostController@index')->name('admin.post.index');
	Route::get('/posts/create', 'PostController@create')->name('admin.post.create');
	Route::post('/posts', 'PostController@store')->name('admin.post.store');
	Route::post('/posts/create', 'UploadImage@store')->name('admin.upimage.store');
	Route::delete('/posts/{post}', 'PostController@destroy')->name('admin.post.destroy');

    Route::get('/products', 'ProductController@index')->name('product.index');
    Route::get('/products/create', 'ProductController@create')->name('product.create');
    Route::post('/products', 'ProductController@store')->name('product.store')->middleware('auth');
    Route::delete('/products/{product}', 'ProductController@destroy')->name('product.destroy');
    Route::get('/products/{product}/edit', 'ProductsController@edit')->name('product.edit');
    // Route::post('/products/{product}', 'ProductsController@update')->name('products.update');
});

Route::get('/posts', 'Customer\PostController@index')->name('customer.post.index');
Route::get('/posts/{post}', 'Customer\PostController@show')->name('customer.post.show');

Route::namespace('Frontend')->group(function() {
    Route::get('/add-to-cart/{id}', 'CartController@addToCart')->name('cart.addToCart');
    Route::delete('/delete-cart-item/{id}', 'CartController@deleteCartItem')->name('cart.delCartItem');
    Route::get('/delete-cart-all', 'CartController@delCartAll')->name('cart.delCartAll');
    Route::get('/shopping-cart', 'CartController@shoppingCart')->name('cart.shoppingCart');
    Route::post('/up-cart-quantity/{id}', 'CartController@upCartQuantity')->name('cart.upCartQuantity');
    Route::get('/down-cart-quantity/{id}', 'CartController@downCartQuantity')->name('cart.downCartQuantity');
    Route::get('/product/{product}', 'ProductController@show')->name('product.show');
});
