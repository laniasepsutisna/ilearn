<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

	/**
	 * Login and Logout Route
	 */
	Route::get('/', 'LoginController@index');
	Route::get('auth/login', 'LoginController@index');
	Route::post('auth/login', 'LoginController@auth');
	Route::get('auth/logout', 'LoginController@logout');

	Route::get('/home', ['middleware' => 'auth', function () {
		return view('home');
	}]);
});