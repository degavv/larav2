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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', 'PhotoController@index')->name('home');
// Route::resource('photo', 'PhotoController', [
//     'except' => ['show'],
// ]);


Route::get('/', 'PhotoController@index')->name('index');
Route::get('/create', 'PhotoController@create')->name('create');
Route::post('/', 'PhotoController@store')->name('store');
Route::auth();

Route::get('/home', 'HomeController@index');
