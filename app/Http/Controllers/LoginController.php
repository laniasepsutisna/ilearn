<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	/**
	 * [index Show login page as index before login]
	 * @return [view] [view of login page]
	 */
	
	public function index()
	{
		if( Auth::check() ) {
			return redirect()->intended('/home');
		}

		return view('auth.login');
	}

	/**
	 * [auth Login attemp with username and password]
	 * @return redirect to /home            
	 */
	
	public function auth(LoginRequest $request)
	{
		$username = $request->get('username');
		$password = $request->get('password');
		$remember = $request->get('remember');

		if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 'active'], $remember)) {
            return redirect()->intended('/home');
        }

        return redirect('/')
        		->withInput($request->only('username', 'remember'));
	}

	/**
	 * Logout
	 * @return url redirect to home
	 */
	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}
