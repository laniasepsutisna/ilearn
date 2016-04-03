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

Route::get('/', ['uses' => 'LoginController@index', 'as' => 'login']);
Route::post('/auth/login', ['uses' => 'LoginController@login', 'as' => 'post.login']);
Route::get('/auth/logout', ['uses' => 'LoginController@logout', 'as' => 'get.logout']);

Route::get('password/email', ['uses' => 'Auth\PasswordController@getEmail', 'as' => 'email.request']);
Route::post('password/email', ['uses' => 'Auth\PasswordController@postEmail', 'as' => 'email.store']);
Route::get('password/reset/{token}', ['uses' => 'Auth\PasswordController@getReset', 'as' => 'reset.request']);
Route::post('password/reset', ['uses' => 'Auth\PasswordController@postReset', 'as' => 'reset.store']);

Route::group(['prefix' => '/lms-admin/', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:staff']], function () {
	Route::get('/', ['uses' => 'HomeController@index', 'as' => 'lms-admin.index'] );	
	Route::get('/profile',['uses' => 'HomeController@profile', 'as' => 'lms-admin.profile']);
	Route::match(['put', 'patch'], '/profile/{users}', ['uses' => 'HomeController@update', 'as' => 'lms-admin.update']);
	Route::match(['put', 'patch'], '/profile/password/{users}', ['uses' => 'HomeController@passwordupdate', 'as' => 'lms-admin.passwordupdate']);
	Route::match(['put', 'patch'], '/profile/changeimage', ['uses' => 'HomeController@changeimage', 'as' => 'lms-admin.changeimage']);
	Route::resource('/users', 'UserController', ['except' => 'show']);
	Route::resource('/majors', 'MajorController', ['except' => 'show']);
	Route::resource('/subjects', 'SubjectController', ['except' => 'show']);
	Route::resource('/announcements', 'AnnouncementController', ['except' => 'show']);
	Route::resource('/classrooms', 'ClassroomController', ['except' => 'show']);
	Route::post('/classrooms/addmembers', ['uses' => 'ClassroomController@addMembers', 'as' => 'lms-admin.classrooms.addmembers']);
	Route::delete('/classrooms/removemember/{users}', ['uses' => 'ClassroomController@removeMember', 'as' => 'lms-admin.classrooms.removemember']);
});


Route::group(['namespace' => 'User', 'middleware' => ['auth', 'role:teacher|student']], function () {
	Route::resource('/home', 'HomeController', ['except' => 'show']);
	Route::get('/profile', ['uses' => 'UserController@profile', 'as' => 'user.profile']);
	Route::post('/updateprofile', ['uses' => 'UserController@updateprofile', 'as' => 'user.postprofile']);
	Route::post('/updatepassword', ['uses' => 'UserController@updatepassword', 'as' => 'user.postpassword']);

	Route::resource('/announcements', 'AnnouncementController', ['only' => ['index', 'show']]);
	Route::get('/classrooms/{$classrooms}', ['uses' => 'ClassroomController@show', 'as' => 'classrooms.show']);
	Route::resource('/tasks', 'TaskController');
	Route::resource('/quizes', 'QuizController');
	Route::resource('/files', 'FileController');
	Route::resource('/activities', 'ActivityController', ['except' => ['edit', 'update']]);
});