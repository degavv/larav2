<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'PhotoController@index')->name('index');
Route::get('/create', 'PhotoController@create')->name('create');
Route::post('/', 'PhotoController@store')->name('store');
Route::delete('/{photo}', 'PhotoController@destroy')->name('destroy');
Route::get('/{photo}', 'PhotoController@edit')->name('edit');
Route::patch('/{photo}', 'PhotoController@update')->name('update');

Route::auth();
Route::get('/home', 'HomeController@index');
