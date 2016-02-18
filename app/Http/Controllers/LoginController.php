<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	/**
	 * Show login page as index
	 * Change view if user is authenticated
	 * 
	 * @return a view of home page
	 */
	
	public function index()
	{
		if( Auth::check() ) {
			return view('home');
		}

		return view('auth.login');
	}

	/**
	 * Login process
	 * 
	 * @return redirect to index         
	 */
	
	public function login(LoginRequest $request)
	{
		$username = $request->get('username');
		$password = $request->get('password');
		$remember = $request->get('remember');

		if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'active'], $remember)) {
            return redirect()->intended('/');
        }

        return redirect('/')->withInput($request->only('username', 'remember'));
	}

	/**
	 * Logout process
	 * 
	 * @return url redirect to index
	 */
	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}
