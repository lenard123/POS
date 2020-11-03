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

    Route::middleware('cashier')->group(function () {
        Route::view('/', 'cashier.index')->name('cashier');
        Route::get('/search', 'Product\SearchController@search')->name('search');
        Route::view('/process', 'cashier.process')->name('process');
    });


    Route::middleware('admin')->group(function () {
        Route::get('/admin', 'Product\GetController@index')->name('admin');
        Route::get('/admin/product', 'Product\GetController@add')->name('addproduct');
        Route::get('/admin/product/{id}/addstock', 'Product\GetController@addStock')->name('addstock');
        Route::get('/admin/product/{id}', 'Product\GetController@update')->name('updateproduct');
        Route::get('/admin/category', 'Category\GetController@index')->name('category');
        Route::get('/admin/account', 'User\GetController@index')->name('account');

        Route::post('/admin/category', 'Category\AddController@add');
        Route::delete('/admin/category/{id}', 'Category\DeleteController@delete');
        Route::put('/admin/category/{id}', 'Category\UpdateController@update');

        Route::post('/admin/product', 'Product\AddController@add');
        Route::put('/admin/product/{id}/addstock', 'Product\AddStockController@addStock');
        Route::put('/admin/product/{id}', 'Product\UpdateController@update');
        Route::delete('/admin/product/{id}', 'Product\DeleteController@delete');

        Route::post('/admin/account', 'User\RegisterController@register');
        Route::put('/admin/account', 'User\UpdateController@update');
        Route::put('/admin/account/password', 'User\ChangePasswordController@changePassword');
    });

    /***
     * Route::post('/process', function (Request $request) {
     *   dd(request('carts'));
     * })->name('process_order');
     ***/
    Route::get('/logout', 'User\LogoutController@logout')->name('logout');
});



//Auth::routes();

Route::view('/login', 'login')->name('login')->middleware('guest');
Route::post('/login', 'User\LoginController@login');
