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

Route::get('login', 'App\Http\Controllers\MainController@login');

Route::post('dashboard', 'App\Http\Controllers\MainController@dologin')->name('login');

Route::get('dashboard', 'App\Http\Controllers\MainController@dashboard');

Route::get('logout', 'App\Http\Controllers\MainController@logout');


