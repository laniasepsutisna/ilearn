<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Models\User;

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
		$remember = $request->get('remember');

		if (Auth::attempt([
			$this->loginUsername() => $username,
			'password' => $password,
			'status' => 'active'
		], $remember)) {
			$this->clearLoginAttempts($request);
        	User::where('id', Auth::user()->id)->update(['login' => 1]);

            return redirect()->intended('/');
        }

        if (! $lockedOut) {
            $this->incrementLoginAttempts($request);
        }

        return $this->sendFailedLoginResponse($request);
	}

	public function sendFailedLoginResponse($request)
	{		
        return redirect()->back()
        	->withInput($request->only($this->loginUsername(), 'remember'))
        	->withErrors([
        		'username' => 'Username dan password tidak cocok atau akun sedang di banned.'
			]);
	}

	public function logout()
	{		
        User::where('id', Auth::user()->id)->update(['login' => 0]);
		Auth::logout();
		return redirect('/');
	}
}
