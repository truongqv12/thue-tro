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
Route::get('/admin/login', 'Admin\AdminAuthController@getAdminLogin')->name('login_admin');
Route::post('/admin/login', 'Admin\AdminAuthController@postAdminLogin');
Route::get('/admin/logout', 'Admin\AdminAuthController@getAdminLogout')->name('logout_admin');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function (){
    Route::get('/', 'admin\DashboardController@index')->name('admin');
    Route::group(['prefix' => 'profile'], function (){
        Route::get('/', 'Admin\ProfileController@index')->name('admin_profile');
        Route::post('/', 'Admin\ProfileController@edit')->name('admin_profile');
    });
    Route::group(['prefix' => 'administration'], function (){
        Route::get('/', 'Admin\AdminController@index')->name('administration');
        //thêm
        Route::get('/add', 'Admin\AdminController@add')->name('administration_add');
        Route::post('/add', 'Admin\AdminController@create')->name('administration_add');
        // sửa
        Route::get('/edit/{id}', 'Admin\AdminController@edit')->name('administration_edit');
        Route::post('/edit/{id}', 'Admin\AdminController@update')->name('administration_edit');
        //xóa
        Route::get('/delete/{id}', 'Admin\AdminController@delete')->name('administration_delete');
        //Xem
        Route::get('/info/{id}', 'Admin\AdminController@ajaxInfo')->name('administration_info');
    });

    Route::group(['prefix' => 'ajax'], function (){
        Route::get('/info/{id}', 'Admin\Ajax\ViewInfoController@ajaxInfo')->name('administration_info');
    });
});
