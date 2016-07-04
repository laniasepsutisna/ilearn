<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Auth;

class UserController extends Controller
{
	public function index(Request $request)
	{
		$querystring = $this->buildQueryString($request);
		$users = $this->buildIndexQuery($request);
		$page_title = $request->has('q') ? 'Pencarian ' . $request->q : 'Semua Users';
		
		return view('admin.users.index', compact('users', 'querystring', 'page_title'));
	}

	public function buildQueryString($request)
	{
		$querystring = null;

		if( $request->has('type') ) {
			$querystring['type'] = $request->has('type') ? $request->type : '';
		} elseif($request->has('q')) {
			$querystring['q'] = $request->has('q') ? $request->q : '';
		}

		return $querystring;
	}

	public function buildIndexQuery($request)
	{
		if( $request->has('type') ) {            
			$users = User::where('role', $request->type)
				->orderBy('created_at', 'DESC')
				->paginate(7);
		} elseif( $request->has('q') ){
			$users = User::where(function($query) use ($request){
				$query->where('firstname', 'LIKE', '%' . $request->q . '%')
					->orWhere('lastname', 'LIKE', '%' . $request->q . '%')
					->orWhere('email', 'LIKE', '%' . $request->q . '%');
			})->orderBy('created_at', 'DESC')->paginate(7);
		} else {
			$users = User::orderBy('created_at', 'DESC')->paginate(7);
		}

		return $users;
	}

	public function create(Request $request)
	{
		$users = User::orderBy('created_at', 'DESC')->paginate(7);

		$page_title = $request->has('type') ? ucfirst($request->type) : 'User';
		return view('admin.users.create', compact('users', 'page_title'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'username' => 'required|unique:users,username',
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email|unique:users,email'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'exists' => 'Kolom :attribute tidak ditemukan!',
			'email' => 'Kolom :attribute harus berupa email.'
		]);

		$data = $request->all();
		//default password
		$data['password'] = bcrypt('secret');

		$user = User::create($data);

		$user->usermeta()->create([
			'picture' => 'icon-user-default.png',
			'cover' => 'cover-default.jpg'
		]);


		\Flash::success('User tersimpan.');
		return redirect()->route('lms-admin.users.edit', [$user->id]);
	}

	public function edit(Request $request, $id)
	{
		$users = User::orderBy('created_at', 'DESC')->paginate(7);
		$page_title = 'Edit User';
		$user = User::findOrFail($id);

		return view('admin.users.edit', compact('users', 'user', 'page_title'));
	}

	public function update(Request $request, $id)
	{
		$user = User::findOrFail($id);

		$this->validate($request, [
			'username' => 'required|unique:users,username,' . $user->id,
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required|email|unique:users,email,' . $user->id,
			'nis' => 'unique:user_metas,nis,' . $user->usermeta->id,
			'nisn' => 'unique:user_metas,nisn,' . $user->usermeta->id,
			'telp' => 'unique:user_metas,telp,' . $user->usermeta->id,
			'telp_orangtua' => 'unique:user_metas,telp_orangtua,' . $user->usermeta->id,
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'exists' => 'Kolom :attribute tidak ditemukan!',
			'email' => 'Kolom :attribute harus berupa email.'
		]);
		
		$user->update($request->all());

		$data = $request->except(
			['username', 'firstname', 'lastname', 'role', 'email', 'status', 'bio', 'major_id', '_method', '_token']
		);

		if($request->has('major_id')) {
			$data['major_id'] = $request->major_id;
		}

		$user->usermeta()->update($data);

		\Flash::success('User diperbaharui.');
		return redirect()->back();
	}
	
	public function destroy($id)
	{
		User::findOrFail($id)->delete();

		\Flash::success('User berhasil dihapus.');
		return redirect()->back();
	}

}
