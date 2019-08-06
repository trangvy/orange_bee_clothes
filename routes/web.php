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
});
