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

Route::post('emails/datatable', 'EmailController@datatable')->name('emails_datatable');
Route::get('emails/{id}/active', 'EmailController@active')->name('emails_active');
Route::resource('emails', 'EmailController');
