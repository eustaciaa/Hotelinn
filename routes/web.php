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

Route::get('/','HomeController@index');

Route::get('/getHotel','HomeController@getHotel');

Route::get('/rentHotel','HomeController@rentHotel');

<<<<<<< HEAD
Route::get('/rentRoom','HomeController@rentRoom');

Route::post('/rentFinal','HomeController@rentFinal');

Route::post('/history','UserController@history');

=======
>>>>>>> fb91618c4f87c0abe708f14b37981d686b684929
