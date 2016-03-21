<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	use AuthenticatesAndRegistersUsers,ThrottlesLogins;

	protected $username = 'username';

    public function index()
    {
        if(Auth::check()) {            
            if( Auth::user()->role === 'staff' ) {
                return redirect()->intended('/lms-admin');
            } else {
                return redirect()->intended('/home');
            }
        }

        $page_title = 'Login';
        
        return view('auth.login', compact('page_title'));
    }

	public function login(Request $request)
	{
        $this->validate($request, [
            'username' => 'required|max:22',
            'password' => 'required|min:6',
        ], [
            'required' => 'Kolom :attribute diperlukan!',
            'min' => 'Oops! :attribute minimal 6 karakter.'
        ]);

        if ($lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

		if (Auth::attempt([
			$this->loginUsername() => $request->username,
			'password' => $request->password,
			'status' => 'active'
		], $request->remember)) {
			$this->clearLoginAttempts($request);
        	User::where('id', Auth::user()->id)->update(['login' => 1]);

            if( Auth::user()->role === 'staff' ) {
                return redirect()->intended('/lms-admin');
            } else {
                return redirect()->intended('/home');
            }
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
		return redirect()->route('login');
	}

}
