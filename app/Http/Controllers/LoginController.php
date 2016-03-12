<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
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

    public function profile()
    {
        $user = User::where('username', Auth::user()->username)->first();
        $page_title = 'Profile';

        return view('users.profile', compact('user', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'identitynumber' => 'required|unique:users',
            'username' => 'required|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'telp_no' => 'integer|beetween:9,12',
            'parent_telp_no' => 'integer|beetween:9,12'
        ]);
        
        $user = User::findOrFail($id);

        $user->update($request->all());

        $user->usermetas()->update([
            'dateofbirth' => $request->dateofbirth,
            'address' => $request->address,
            'telp_no' => $request->telp_no,
            'parent_telp_no' => $request->parent_telp_no
        ]);

        \Flash::success('Profil berhasil diperbaharui.');
        return redirect()->back();
    }

    public function passwordupdate(Request $request, $id)
    {
    	$this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);

        $user = User::findOrFail($id);
        if( $request->has('password') ) {
        	$user->update(['password' => bcrypt($request->password)]);
        }

        \Flash::success('Password berhasil diperbaharui.');
        return redirect()->back();
    }
}
