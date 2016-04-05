<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;

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
            $users = User::where('role', $request->type)->orderBy('created_at', 'DESC')->paginate(7);
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

        $user = User::create($request->all());

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

        $user->usermeta()->update([            
            'nis' => $request->nis,
            'nisn' => $request->nisn,
            'major_id' => $request->jurusan,
            'agama' => $request->agama,
            'tempatlahir' => $request->tempatlahir,
            'tanggallahir' => $request->tanggallahir,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
            'orangtua' => $request->orangtua,
            'wali' => $request->wali,
            'telp_orangtua' => $request->telp_orangtua,
        ]);

        \Flash::success('User diperbaharui.');
        return redirect()->back();
    }
    
    public function destroy($id)
    {
        User::find($id)->delete();

        \Flash::success('User berhasil dihapus.');
        return redirect()->back();
    }

}
