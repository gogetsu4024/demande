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


/*Route::get('/users/{id} ', function ($id) {
    return $id;
});*/

Auth::routes();
Route::middleware('admin')->group(function ()
{
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
});
Route::middleware('member')->group(function ()
{
    Route::get('/', 'HomeController@index2');
    Route::get('/calendrier', 'CalendrierController@index')->name('calendrier.index');
    Route::resource('/clients','ClientsController');
    Route::resource('/projets','ProjetsController');
    Route::resource('/missions','MissionsController');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );
});

Route::get('/unauthorised', function () {
    return view('unauthorized');
});
