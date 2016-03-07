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
	Route::get('announcements/trash', ['uses' => 'AnnouncementController@trash', 'as' => 'announcements.trash']);
	Route::match(['put', 'patch'],'announcements/restore/{announcements}', ['uses' => 'AnnouncementController@restore', 'as' => 'announcements.restore']);
	Route::delete('announcements/forcedelete/{announcements}', ['uses' => 'AnnouncementController@forceDelete', 'as' => 'announcements.forcedelete']);

	Route::resource('/users', 'UserController', ['except' => 'show']);
	Route::get('users/trash', ['uses' => 'UserController@trash', 'as' => 'users.trash']);
	Route::match(['put', 'patch'], 'users/restore/{users}', ['uses' => 'UserController@restore', 'as' => 'users.restore']);
	Route::delete('users/forcedelete/{users}', ['uses' => 'UserController@forceDelete', 'as' => 'users.forcedelete']);
});