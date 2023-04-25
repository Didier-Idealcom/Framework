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

Route::resource('domains', 'DomainController');
Route::get('domains/{domain}/active', 'DomainController@active')->name('domains_active');
Route::post('domains/datatable', 'DomainController@datatable')->name('domains_datatable');

Route::resource('domains_languages', 'DomainLanguageController')->except(['index', 'create'])->parameters(['domains_languages' => 'domain_language']);
Route::get('domains/{domain}/domains_languages', 'DomainLanguageController@index')->name('domains_languages.index');
Route::get('domains/{domain}/domains_languages/create', 'DomainLanguageController@create')->name('domains_languages.create');
Route::get('domains_languages/{domain_language}/active', 'DomainLanguageController@active')->name('domains_languages_active');
Route::get('domains_languages/{domain_language}/default', 'DomainLanguageController@default')->name('domains_languages_default');
Route::post('domains/{domain}/domains_languages/datatable', 'DomainLanguageController@datatable')->name('domains_languages_datatable');
