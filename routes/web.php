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

Route::get('admin/brands', 'Admin\BrandController@index')->name('admin.brand.index');
Route::get('/admin/brands/create', 'Admin\BrandController@create')->name('admin.brand.create');
Route::post('admin/brands/{brand}', 'Admin\BrandController@update')->name('admin.brand.update');
Route::get('admin/brands/{brand}/edit', 'Admin\BrandController@edit')->name('admin.brand.edit');
Route::post('/admin/brands', 'Admin\BrandController@store')->name('admin.brand.store');
Route::delete('admin/brands/{brand}', 'Admin\BrandController@destroy')->name('admin.brand.destroy');
