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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::prefix('admin')->group(function() {
	Route::get('modules', 'Admin\ModulesController@index')->name('admin.modules');
});

/*$menuitems = [];
$menuitems[] = (object)array('id' => 1, 'gabarit' => 'actualite-index', 'permalink' => 'permalink1');
$menuitems[] = (object)array('id' => 2, 'gabarit' => 'product-index', 'permalink' => 'permalink2');
$menuitems[] = (object)array('id' => 3, 'gabarit' => 'product-index', 'permalink' => 'permalink2/categorie');
$menuitems[] = (object)array('id' => 4, 'gabarit' => 'newsletter_user-index', 'permalink' => 'permalink4');
if (!empty($menuitems)) {
	foreach ($menuitems as $menuitem) {
		$gabarit_array = explode('-', $menuitem->gabarit);
		$controller_array = explode('_', $gabarit_array[0]);
		$controller = implode('', array_map('ucfirst', $controller_array));
		$method = $gabarit_array[1];
		Route::get($menuitem->permalink, $controller . 'Controller@' . $method)->name('menuitem' . $menuitem->id);
	}
}*/

//Route::get('{menuitem}/{actualite}', 'ActualiteController@show');
//Route::get('{menuitem}/{product}', 'ProductController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
