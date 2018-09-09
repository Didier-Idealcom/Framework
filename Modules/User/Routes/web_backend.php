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

Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login')->name('login-post');
Route::post('logout', 'LoginController@logout')->name('logout');

Route::resource('users', 'UserController');
Route::post('users/datatable', 'UserController@datatable')->name('users_datatable');

Route::resource('roles', 'RoleController');
Route::post('roles/datatable', 'RoleController@datatable')->name('roles_datatable');

Route::resource('permissions', 'PermissionController');
Route::post('permissions/datatable', 'PermissionController@datatable')->name('permissions_datatable');
