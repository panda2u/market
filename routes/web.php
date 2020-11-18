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

/*
| __________
| default laravel welcome page
| __________
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'App\Http\Controllers\MainController@index');

Route::get('catalog', 'App\Http\Controllers\MainController@catalog');

Route::get('admin', 'App\Http\Controllers\MainController@admin');

Route::get('prelogin', 'App\Http\Controllers\MainController@prelogin');

Route::post('login', 'App\Http\Controllers\MainController@dologin')->name('login');
