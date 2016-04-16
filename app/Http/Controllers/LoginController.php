<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use App\Models\User;

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
		User::where('id', Auth::user()->id)->update(['login' => 0]);
		Auth::logout();
		return redirect()->route('login');
	}

	public function update(Request $request)
	{
		$user = User::findOrFail(Auth::user()->id);

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

		$user->usermeta()->update([
			'tempatlahir' => $request->tempatlahir,
			'tanggallahir' => $request->tanggallahir,
			'alamat' => $request->alamat,
			'telp' => $request->telp
		]);

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

		$user = User::findOrFail(Auth::user()->id);
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
		$user = User::findOrFail(Auth::user()->id);

		if($request->hasFile('image')){
			$data[$request->field] = $this->saveImage($request->file('image'), $cover);
			$user->usermeta()->update($data);
		}

		return redirect()->back();
		
	}

	public function saveImage(UploadedFile $image, $cover = false)
	{
		$fileName = Uuid::uuid1() . '.' . $image->getClientOriginalExtension();
		$destination = public_path() . DIRECTORY_SEPARATOR . 'uploads';
		$uploaded = $image->move($destination, $fileName);

		if($cover) {
			Image::make($uploaded)->fit(280,175)->save($destination . '/280x175-' . $fileName);
		} else {
			Image::make($uploaded)->fit(45,45)->save($destination . '/45x45-' . $fileName);
			Image::make($uploaded)->fit(120,120)->save($destination . '/120x120-' . $fileName);
		}

		return $fileName;
	}

}