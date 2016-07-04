<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use Auth;

class LoginController extends Controller
{
	use AuthenticatesAndRegistersUsers,ThrottlesLogins;

	protected $username = 'username';

	public function index()
	{
		if(Auth::check()) {
			if( Auth::user()->hasRole('staff') ) {
				return redirect()->intended('/lms-admin');
			} else {
				return redirect()->intended('/home');
			}
		}

		$page_title = 'Login';
		$announcements = Announcement::where('status', 'info')->limit(3)->get();
		
		return view('auth.login', compact('page_title', 'announcements'));
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
			], $request->remember)
		) {

			$this->clearLoginAttempts($request);

			Auth::user()->login = 1;
			Auth::user()->save();

			if( Auth::user()->hasRole('staff') ) {
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
		Auth::user()->login = 0;
		Auth::user()->save();
		Auth::logout();
		return redirect()->route('login');
	}

	public function update(Request $request)
	{
		$user = Auth::user();

		$this->validate($request, [
			'username' => 'required|unique:users,username,' . $user->id,
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email|unique:users,email,' . $user->id,
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'unique' => 'Kolom :attribute sudah dipakai!',
			'email' => 'Kolom :attribute harus berupa email!'
		]);

		$user->update($request->all());

		$user->usermeta->update($request->all());

		\Flash::success('Profil berhasil diperbaharui.');
		return redirect()->back();
	}

	public function passwordUpdate(Request $request)
	{
		$this->validate($request, [
			'password' => 'required|confirmed|min:6',
			'password_confirmation' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'confirmed' => 'Kolom :attribute tidak cocok!'
		]);

		$user = Auth::user();
		if( $request->has('password') ) {
			$user->update(['password' => bcrypt($request->password)]);
		}

		\Flash::success('Password berhasil diperbaharui.');
		return redirect()->back();
	}

	public function changeImage(Request $request)
	{
		$this->validate($request,[
			'field' => 'required',
			'image' => 'required|mimes:jpeg,png'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'mimes' => 'Format file harus *.jpg, *.png *.bmp'
		]);

		$data = [];
		$cover = $request->field === 'cover' ? true : false;
		$user = Auth::user();

		if($request->hasFile('image')){
			$data[$request->field] = $this->saveImage($request->file('image'), $cover);
			$user->usermeta->update($data);
		}

		return redirect()->back();		
	}

	public function saveImage(UploadedFile $image, $cover = false)
	{
		$fileName = Uuid::uuid1() . '.' . $image->getClientOriginalExtension();
		$destination = public_path() . DIRECTORY_SEPARATOR . 'uploads';
		$uploaded = $image->move($destination, $fileName);

		if($cover) {
			Image::make($uploaded)->fit(253,190)->save($destination . '/253x190-' . $fileName);
		} else {
			Image::make($uploaded)->fit(45,45)->save($destination . '/45x45-' . $fileName);
			Image::make($uploaded)->fit(120,120)->save($destination . '/120x120-' . $fileName);
		}

		return $fileName;
	}

}