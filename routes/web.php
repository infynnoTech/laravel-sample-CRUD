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
Route::group(['middleware' => ['auth']], function ()
{
    Route::get('/home', 'HomeController@index')->name('home');
    // Category Actions
    Route::get('/categories', 'CategoryController@index')->name('categories');
    Route::post('/add-catelgory', 'CategoryController@store')->name('add_catelgory');
    Route::post('/edit-catelgory', 'CategoryController@edit')->name('edit_catelgory');
    Route::post('/update-catelgory', 'CategoryController@update')->name('update_catelgory');
    Route::post('/delete-catelgory', 'CategoryController@destroy')->name('delete_catelgory');

    //product Actions
    Route::get('/products', 'ProductController@index')->name('products');
    Route::get('/add-product', 'ProductController@create')->name('add_product');
    Route::post('/save-product', 'ProductController@store')->name('save_product');
    Route::get('/edit-products/{id}', 'ProductController@edit')->name('edit_product');
    Route::get('/products-list/', 'ProductController@ajaxPagination')->name('product_list');
    Route::post('/update-product', 'ProductController@update')->name('update_product');
    Route::post('/delete-product', 'ProductController@destroy')->name('delete_product');
    Route::post('/delete-product-image', 'ProductController@destroyProductImage')->name('delete_product_image');

    // user Actions
    Route::get('/users', 'UserController@index')->name('users');
    Route::post('/add-user', 'UserController@store')->name('add_user');
    Route::post('/edit-user', 'UserController@edit')->name('edit_user');
    Route::post('/update-user', 'UserController@update')->name('update_user');
    Route::post('/delete-user', 'UserController@destroy')->name('delete_user');
});
