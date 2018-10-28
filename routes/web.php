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

Route::middleware('auth')->group(function () {
    Route::view('/', 'cashier.index')->name('cashier');

    Route::middleware('admin')->group(function () {
        Route::get('/admin', 'Product\GetController@index')->name('admin');
        Route::get('/admin/product', 'Product\GetController@add')->name('addproduct');
        Route::get('/admin/category', 'Category\GetController@index')->name('category');

        Route::post('/admin/category', 'Category\AddController@add');
        Route::delete('/admin/category/{id}', 'Category\DeleteController@delete');
        Route::put('/admin/category/{id}', 'Category\UpdateController@update');

        Route::post('/admin/product', 'Product\AddController@add');
    });



    Route::get('/logout', 'User\LogoutController@logout')->name('logout');
});



//Auth::routes();

Route::view('/login', 'login')->name('login');
Route::post('/login', 'User\LoginController@login');
