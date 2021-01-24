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

Route::get('/wipe', 'App\Http\Controllers\MainController@wipe')->name('wipe');

Route::get('/', 'App\Http\Controllers\MainController@index')->name('home');

Route::get('catalog', 'App\Http\Controllers\MainController@catalog')->name('catalog');

Route::post('filter', 'App\Http\Controllers\MainController@filter_catalog')->name('filter');

Route::get('login', 'App\Http\Controllers\MainController@login');

Route::post('dologin', 'App\Http\Controllers\MainController@dologin')->name('login');

Route::get('dashboard', 'App\Http\Controllers\MainController@dashboard')->name('dashboard');

Route::get('logout', 'App\Http\Controllers\MainController@logout');

/* Goods */

Route::get('good/new', 'App\Http\Controllers\MainController@new_good')->name('good.new');

Route::post('good/create', 'App\Http\Controllers\MainController@create_good')->name('good.create');

Route::get('good/show/{good_id}', 'App\Http\Controllers\MainController@show_good')->name('good.show');

Route::get('good/edit/{good_id}', 'App\Http\Controllers\MainController@edit_good')->name('good.edit');

Route::post('good/update/{good_id}', 'App\Http\Controllers\MainController@update_good')->name('good.update');

Route::post('good/delete/{good_id}', 'App\Http\Controllers\MainController@delete_good')->name('good.delete');

Route::post('image/delete/{good_id}', 'App\Http\Controllers\MainController@delete_image')->name('image.delete');

/* Properties */

Route::get('properties', 'App\Http\Controllers\MainController@edit_props')->name('props');

Route::post('update_props', 'App\Http\Controllers\MainController@update_props');
