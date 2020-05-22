<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();

Route::get('/','MainController@index');


Route::get('/getHotel','MainController@getHotel');

Route::get('/rentHotel','MainController@rentHotel');

Route::get('/rent','RentController@rent');

Route::post('/updateProfile','UserController@updateProfile');

Route::post('/profile','UserController@profile');

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

    Route::get('/','AdminController@index')->name('admin.dashboard');
});

Route::post('/rentFinal','RentController@rentFinal');

Route::post('/history','UserController@history');

Route::post('/getKota','AJAXController@getKota');

Route::get('/showRoom','MainController@showRoom');

Route::get('/home', 'HomeController@index')->name('home');
