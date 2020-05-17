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

Route::get('/rentRoom','MainController@rentRoom');

Route::post('/rentFinal','MainController@rentFinal');

Route::post('/history','UserController@history');

Route::post('/getKota','AJAXController@getKota');

