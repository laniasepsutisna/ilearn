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

	Route::get('/', ['uses' => 'LoginController@index', 'as' => 'auth.index'] );
	Route::post('auth/login', ['uses' => 'LoginController@login', 'as' => 'auth.login']);
	Route::get('auth/logout', ['uses' => 'LoginController@logout', 'as' => 'auth.logout']);

	Route::resource('/announcements', 'AnnouncementController', ['except' => 'show']);
});