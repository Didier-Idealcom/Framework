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

Route::post('languages/datatable', 'LanguageController@datatable')->name('languages_datatable');
Route::get('languages/{language}/active', 'LanguageController@active')->name('languages_active');
Route::resource('languages', 'LanguageController');
