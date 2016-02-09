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

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function () {
	    return view('login');
	});
});

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

Route::get('login/{name}', function($name)
{
    auth()->logout();

    $name = ucfirst(strtolower($name));

    $user = App\User::where('name', $name)->firstOrFail();

    auth()->login($user);

    return redirect('/home');
});

Route::get('/home', ['middleware' => 'role:staff', function(){
	return 'Admin page';
}
]);

/*
Route::get('/home', [ 'middleware' => ['web'] ,function() {
	Auth::loginUsingId(3);
	//Auth::logout();

	if( Auth::user()->hasRole('staff') ){
		return 'I am a staff!';
	} elseif( Auth::user()->hasRole('teacher') ){
		return 'Hi, I am a teacher.';
	} elseif( Auth::user()->hasRole('student') ){
		return 'Me student.';
	} else {
		return 'No user role defined!';
	}

}]);
*/