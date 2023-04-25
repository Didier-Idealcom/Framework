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

Route::post('pages/datatable', 'PageController@datatable')->name('pages_datatable');
Route::get('pages/{page}/active', 'PageController@active')->name('pages_active');
Route::get('pages/{page}/duplicate', 'PageController@duplicate')->name('pages_duplicate');
Route::post('pages/{page}/preview', 'PageController@preview')->name('pages_preview')->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::resource('pages', 'PageController');
