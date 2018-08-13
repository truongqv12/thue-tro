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

//admin login
Route::get('/admin/login', 'admin\AdminAuthController@getAdminLogin')->name('login_admin');
Route::post('/admin/login', 'admin\AdminAuthController@postAdminLogin');
Route::get('/admin/logout', 'admin\AdminAuthController@getAdminLogout')->name('logout_admin');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function (){
    Route::get('/', 'admin\DashboardController@index')->name('admin');

    Route::group(['prefix' => 'administration'], function (){
        Route::get('/', 'admin\AdminController@index')->name('administration');
        Route::get('/add', 'admin\AdminController@add')->name('administration_add');
        Route::post('/add', 'admin\AdminController@create')->name('administration_add');
    });

});
