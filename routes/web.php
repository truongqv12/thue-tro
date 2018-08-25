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

//backend login
Route::get('/admin/login', 'backend\AdminAuthController@getAdminLogin')->name('login_admin');
Route::post('/admin/login', 'backend\AdminAuthController@postAdminLogin');
Route::get('/admin/logout', 'backend\AdminAuthController@getAdminLogout')->name('logout_admin');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function (){
    Route::get('/', 'backend\DashboardController@index')->name('admin');


    Route::group(['prefix' => 'profile'], function (){
        Route::get('/', 'backend\ProfileController@index')->name('admin_profile');
        Route::post('/', 'backend\ProfileController@edit');
    });


    Route::group(['prefix' => 'administration'], function (){
        Route::get('/', 'backend\AdminController@index')->name('administration');
        //thêm
        Route::get('/add', 'backend\AdminController@add')->name('administration_add');
        Route::post('/add', 'backend\AdminController@create');
        // sửa
        Route::get('/edit/{id}', 'backend\AdminController@edit')->name('administration_edit');
        Route::post('/edit/{id}', 'backend\AdminController@update');
        //xóa
        Route::get('/delete/{id}', 'backend\AdminController@delete')->name('administration_delete');
        //Xem
    });

    Route::group(['prefix' => 'city'], function (){
       Route::get('/', 'backend\CityController@index')->name('city');
        //thêm
        Route::get('/add', 'backend\CityController@add')->name('city_add');
        Route::post('/add', 'backend\CityController@create');
        //Sửa
        Route::get('/edit/{id}', 'backend\CityController@edit')->name('city_edit');
        Route::post('/edit/{id}', 'backend\CityController@update');
        //Xóa
        Route::get('/delete/{id}', 'backend\CityController@delete')->name('city_delete');
;
    });

    Route::group(['prefix' => 'ajax'], function (){
        Route::get('/info/{id}', 'backend\Ajax\ViewInfoController@ajaxInfo')->name('administration_info_ajax');
    });
});
