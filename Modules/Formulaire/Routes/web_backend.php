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

Route::post('formulaires/datatable', 'FormulaireController@datatable')->name('formulaires_datatable');
Route::post('formulaires/{formulaire}/formulaires_fields/datatable', 'FormulaireFieldController@datatable')->name('formulaires_fields_datatable');
Route::get('formulaires/{formulaire}/active', 'FormulaireController@active')->name('formulaires_active');
Route::get('formulaires_fields/{formulaire_field}/active', 'FormulaireFieldController@active')->name('formulaires_fields_active');
Route::resource('formulaires', 'FormulaireController');
Route::resource('formulaires_fields', 'FormulaireFieldController')->except(['index', 'create'])->parameters(['formulaires_fields' => 'formulaire_field']);
Route::get('formulaires/{formulaire}/formulaires_fields', 'FormulaireFieldController@index')->name('formulaires_fields.index');
Route::get('formulaires/{formulaire}/formulaires_fields/create', 'FormulaireFieldController@create')->name('formulaires_fields.create');
