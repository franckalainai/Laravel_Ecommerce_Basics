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


Route::match(['get', 'post'] ,'/admin', 'AdminController@login');

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->group(function () {
    Route::get('/dashboard', 'AdminController@dashboard');
    Route::get('/settings', 'AdminController@settings');
    Route::get('/check-pwd', 'AdminController@chkPassword');

    // categories routes admin
    Route::match(['get', 'post'], '/update-pwd', 'AdminController@updatePassword');
    Route::match(['get', 'post'], '/add-category', 'CategoryController@addCategory');
    Route::get('/view-categories', 'CategoryController@viewCategories');
    Route::match(['get', 'post'], 'edit-category/{id}', 'CategoryController@editCategory');
    Route::match(['get', 'post'], 'delete-category/{id}', 'CategoryController@deleteCategory');

    // products routes admin
    Route::match(['get', 'post'],'add-product', 'ProductsController@addProduct');
    });
});


Route::get('/logout', 'AdminController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
