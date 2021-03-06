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

Route::post('pages/datatable', 'PageController@datatable')->name('pages_datatable');
Route::get('pages/{page}/active', 'PageController@active')->name('pages_active');
Route::resource('pages', 'PageController');
