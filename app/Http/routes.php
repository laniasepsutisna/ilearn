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

	Route::get('/', ['uses' => 'LoginController@index', 'as' => 'login']);
	Route::post('/login', ['uses' => 'LoginController@login', 'as' => 'post.login']);
	Route::get('/logout', ['uses' => 'LoginController@logout', 'as' => 'get.logout']);

	Route::get('password/email', ['uses' => 'Auth\PasswordController@getEmail', 'as' => 'email.request']);
	Route::post('password/email', ['uses' => 'Auth\PasswordController@postEmail', 'as' => 'email.store']);
	Route::get('password/reset/{token}', ['uses' => 'Auth\PasswordController@getReset', 'as' => 'reset.request']);
	Route::post('password/reset', ['uses' => 'Auth\PasswordController@postReset', 'as' => 'reset.store']);
	
	Route::group(['namespace' => 'User'], function () {
		Route::resource('/home', 'HomeController', ['except' => 'show']);
	});

	Route::group(['prefix' => '/lms-admin/', 'namespace' => 'Admin'], function () {
		Route::get('/', ['uses' => 'HomeController@index', 'as' => 'lms-admin.index'] );	
		Route::get('/profile',['uses' => 'HomeController@profile', 'as' => 'lms-admin.profile']);
		Route::match(['put', 'patch'],'/profile/{users}', ['uses' => 'HomeController@update', 'as' => 'lms-admin.update']);
		Route::match(['put', 'patch'],'/profile/password/{users}', ['uses' => 'HomeController@passwordupdate', 'as' => 'lms-admin.passwordupdate']);
		Route::resource('/users', 'UserController', ['except' => 'show']);
		Route::resource('/majors', 'MajorController', ['except' => 'show']);
		Route::resource('/subjects', 'SubjectController', ['except' => 'show']);
		Route::resource('/announcements', 'AnnouncementController', ['except' => 'show']);
		Route::resource('/classrooms', 'ClassroomController', ['except' => 'show']);
		Route::post('/classrooms/addmembers', ['uses' => 'ClassroomController@addMembers', 'as' => 'lms-admin.classrooms.addmembers']);
		Route::delete('/classrooms/removemember/{users}', ['uses' => 'ClassroomController@removeMember', 'as' => 'lms-admin.classrooms.removemember']);
	});

	Route::group(['prefix' => '/api/v1/', 'namespace' => 'API', 'middleware' => 'throttle:10,1'], function () {
		Route::resource('/users', 'UserController', ['only' => ['index', 'show']]);
		Route::resource('/announcements', 'AnnouncementController', ['only' => ['index', 'show']]);
		Route::resource('/quizes', 'QuizController');
		Route::resource('/tasks', 'TaskController');
		Route::resource('/files', 'FileController');
		Route::resource('/feeds', 'FeedController', ['except' => ['edit', 'update']]);
	});
});