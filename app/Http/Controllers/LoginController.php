<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LoginController extends Controller
{
	use AuthenticatesAndRegistersUsers,ThrottlesLogins;

	protected $username = 'username';

	public function index()
	{
		if( Auth::check() ) {
			return view('home');
		}

		return view('auth.login');
	}

	public function login(LoginRequest $request)
	{
        if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

		$username = $request->get('username');
		$password = $request->get('password');
		$remember = $request->has('remember');

		if (Auth::attempt([
			$this->loginUsername() => $username,
			'password' => $password,
			'status' => 'active'
		], $remember)) {
			$this->clearLoginAttempts($request);

            return redirect()->intended('/');
        }

        if (! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse();
	}

	public function sendFailedLoginResponse()
	{		
        return redirect()->back()
        	->withInput($request->only($this->loginUsername(), 'remember'))
        	->withErrors([
        		'username' => 'Username dan password tidak cocok atau akun sedang di banned.'
			]);
	}

	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}
