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

Route::resource('menus', 'MenuController');
Route::get('menus/{menu}/active', 'MenuController@active')->name('menus_active');
Route::post('menus/datatable', 'MenuController@datatable')->name('menus_datatable');

Route::resource('menuitems', 'MenuitemController')->except(['index', 'create'])->parameters(['menuitems' => 'menuitem']);
Route::get('menus/{menu}/menuitems', 'MenuitemController@index')->name('menuitems.index');
Route::get('menus/{menu}/menuitems/create', 'MenuitemController@create')->name('menuitems.create');
Route::get('menuitems/{menuitem}/active', 'MenuitemController@active')->name('menuitems_active');
Route::post('menus/{menu}/menuitems/datatable', 'MenuitemController@datatable')->name('menuitems_datatable');
