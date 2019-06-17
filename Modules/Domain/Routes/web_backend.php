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

Route::post('domains/datatable', 'DomainController@datatable')->name('domains_datatable');
Route::get('domains/{id}/active', 'DomainController@active')->name('domains_active');
Route::resource('domains', 'DomainController');
