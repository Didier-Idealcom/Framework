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

/* Auth */
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login')->name('login-post');
Route::post('logout', 'LoginController@logout')->name('logout');

/* Dashboard */
Route::get('/', 'DashboardController@index')->name('dashboard');
Route::get('/setlocale/{lang}', 'DashboardController@setlocale')->name('setlocale');
Route::get('/setdomain/{domain}', 'DashboardController@setdomain')->name('setdomain');
Route::get('/media', 'DashboardController@media')->name('media');
Route::post('/media_upload', 'DashboardController@upload')->name('media_upload');

/* Domains */
Route::resource('domains', 'DomainController')->middleware('can:Domain_read');
Route::get('domains/{domain}/active', 'DomainController@active')->name('domains_active')->middleware('can:Domain_edit');
Route::post('domains/datatable', 'DomainController@datatable')->name('domains_datatable');

/* Domains languages */
Route::resource('domains_languages', 'DomainLanguageController')->except(['index', 'create'])->parameters(['domains_languages' => 'domain_language']);
Route::get('domains/{domain}/domains_languages', 'DomainLanguageController@index')->name('domains_languages.index');
Route::get('domains/{domain}/domains_languages/create', 'DomainLanguageController@create')->name('domains_languages.create');
Route::get('domains_languages/{domain_language}/active', 'DomainLanguageController@active')->name('domains_languages_active');
Route::get('domains_languages/{domain_language}/default', 'DomainLanguageController@default')->name('domains_languages_default');
Route::post('domains/{domain}/domains_languages/datatable', 'DomainLanguageController@datatable')->name('domains_languages_datatable');

/* Languages */
Route::resource('languages', 'LanguageController')->middleware('can:Language_read');
Route::get('languages/{language}/active', 'LanguageController@active')->name('languages_active')->middleware('can:Language_edit');
Route::post('languages/datatable', 'LanguageController@datatable')->name('languages_datatable');

/* Users */
Route::resource('users', 'UserController')->middleware('can:User_read');
Route::get('users/{user}/active', 'UserController@active')->name('users_active')->middleware('can:User_edit');
Route::get('users/export', 'UserController@export')->name('users_export');
Route::post('users/datatable', 'UserController@datatable')->name('users_datatable');

/* Roles */
Route::resource('roles', 'RoleController')->middleware('can:Role_read');
Route::post('roles/datatable', 'RoleController@datatable')->name('roles_datatable');

/* Permissions */
Route::resource('permissions', 'PermissionController')->middleware('can:Permission_read');
Route::post('permissions/datatable', 'PermissionController@datatable')->name('permissions_datatable');
