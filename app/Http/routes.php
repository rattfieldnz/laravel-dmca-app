.<?php

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

/**
 * Home Page
 */
//Route::get('/', 'WelcomeController@index');
Route::get('/', 'PagesController@home');

/**
 * Notices
 */
Route::get('notices/crate/confirm', 'NoticesController@confirm');
Route::resource('notices', 'NoticesController');

/**
 * Authentication
 */
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
