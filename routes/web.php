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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
	Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	//Route::view('actualites', 'admin.actualites_index');
	//Route::view('actualites/details', 'admin.actualites_details');
	Route::resource('actualites', 'Admin\ActualitesController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
