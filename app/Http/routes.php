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

Route::get('/', ['as' => 'getRegister', 'uses' => 'MainController@showRegisterForm']);
Route::post('doRegister', 'MainController@create')->name('doRegister');
Route::get('/download/{file}', 'MainController@download')->name('download');;
