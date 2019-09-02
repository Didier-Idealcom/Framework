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

Route::post('users/datatable', 'UserController@datatable')->name('users_datatable');
Route::get('users/{id}/active', 'UserController@active')->name('users_active');
Route::get('users/export', 'UserController@export')->name('users_export');
Route::resource('users', 'UserController');

Route::post('roles/datatable', 'RoleController@datatable')->name('roles_datatable');
Route::get('roles/{id}/active', 'RoleController@active')->name('roles_active');
Route::resource('roles', 'RoleController');

Route::post('permissions/datatable', 'PermissionController@datatable')->name('permissions_datatable');
Route::get('permissions/{id}/active', 'PermissionController@active')->name('permissions_active');
Route::resource('permissions', 'PermissionController');
