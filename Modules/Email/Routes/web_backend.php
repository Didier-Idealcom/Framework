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

Route::resource('emails', 'EmailController');
Route::get('emails/{email}/active', 'EmailController@active')->name('emails_active');
Route::post('emails/datatable', 'EmailController@datatable')->name('emails_datatable');
