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

Route::group(['middleware' => ['web']], function () {
	Route::get('/', ['as' => 'homepage','uses' => 'WelcomeController@index']);
	Route::post('/', ['as' => 'add', 'uses' => 'WelcomeController@add']);
	Route::delete('{repo}', ['as' => 'remove', 'uses' => 'WelcomeController@remove'])->where('repo', '.+/.+');

	Route::get('home', 'HomeController@index');

	Route::controllers([
		'auth' => 'Auth\AuthController',
		'password' => 'Auth\PasswordController',
	]);
});


