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

Route::get('/', 'App\Http\Controllers\MainController@index')->name('home');

Route::get('catalog', 'App\Http\Controllers\MainController@catalog');

Route::get('login', 'App\Http\Controllers\MainController@login');

Route::post('dologin', 'App\Http\Controllers\MainController@dologin')->name('login');

Route::get('dashboard', 'App\Http\Controllers\MainController@dashboard')->name('dashboard');

Route::get('logout', 'App\Http\Controllers\MainController@logout');

/* Goods */

Route::get('good/new', 'App\Http\Controllers\MainController@new_good');

Route::get('goods/{good_id}', 'App\Http\Controllers\MainController@edit_good');

Route::post('good/create', 'App\Http\Controllers\MainController@create_good')->name('good.create');

Route::post('good/update/{good_id}', 'App\Http\Controllers\MainController@update_good')->name('good.update');

Route::post('good/delete/{good_id}', 'App\Http\Controllers\MainController@delete_good')->name('good.delete');

/* Properties */

Route::get('properties', 'App\Http\Controllers\MainController@edit_props')->name('props');

Route::post('update_props', 'App\Http\Controllers\MainController@update_props');
