<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{	
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:maddog,staff');
	}

    public function index(Request $request)
    {
        $querystring = $this->buildQueryString($request);
        $users = $this->buildIndexQuery($request);
        $page_title = $request->has('q') ? 'Pencarian ' . $request->get('q') : 'Users';
        
        return view('users.index', compact('users', 'querystring', 'page_title'));
    }

    public function buildQueryString($request)
    {
        $querystring = null;

        if( $request->has('q') || $request->has('type') ) {
            $querystring['type'] = $request->has('type') ? $request->get('type') : '';
            $querystring['q'] = $request->has('q') ? $request->get('q') : '';
        } elseif($request->has('q')) {
            $querystring['q'] = $request->has('q') ? $request->get('q') : '';
        }

        return $querystring;
    }

    public function buildIndexQuery($request)
    {
        if( $request->has('type') ) {
            $users = Role::where('name', $request->get('type'))->first()->users()
                    ->where(function($query) use ($request){
                        $query->where('identitynumber', 'LIKE', '%' . $request->get('q') . '%')   
                                ->orWhere('firstname', 'LIKE', '%' . $request->get('q') . '%')                        
                                ->orWhere('lastname', 'LIKE', '%' . $request->get('q') . '%')                      
                                ->orWhere('email', 'LIKE', '%' . $request->get('q') . '%');
                    })->orderBy('created_at', 'desc')->paginate(7);
        } elseif( $request->has('q') ){
            $users = User::where(function($query) use ($request){
                        $query->where('identitynumber', 'LIKE', '%' . $request->get('q') . '%')   
                                ->orWhere('firstname', 'LIKE', '%' . $request->get('q') . '%')                        
                                ->orWhere('lastname', 'LIKE', '%' . $request->get('q') . '%')                      
                                ->orWhere('email', 'LIKE', '%' . $request->get('q') . '%');
                    })->orderBy('created_at', 'desc')->paginate(7);
        } else {
            $users = User::orderBy('created_at', 'desc')->paginate(7);
        }

        return $users;
    }

    public function create(Request $request)
    {
        $users = User::orderBy('created_at', 'desc')->paginate(7);

        $page_title = $request->has('type') ? ucfirst($request->get('type')) : 'User';
        return view('users.create', compact('users', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'identitynumber' => 'required|unique:users',
            'username' => 'required|unique:users',
            'firstname' => 'required',
            'lastname' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users'
        ]);

        $user = User::create($request->all());

        $role_id = (int) $request->role;
        $user->assignRole( $role_id );

        $user->usermetas()->create([
            'picture' => 'icon-user-default.png',
            'cover' => 'cover-default.jpg'
        ]);

        \Flash::success('User tersimpan.');
        return redirect()->route('users.edit', [$user->id]);
    }

    public function edit(Request $request, $id)
    {
        $users = User::orderBy('created_at', 'desc')->paginate(7);
        $page_title = 'Edit User';
        $user = User::findOrFail($id);

        return view('users.edit', compact('users', 'user', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'identitynumber' => 'required',
            'username' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
        ]);
        
        $user = User::findOrFail($id);

        $user->update($request->all());
        $user->roles()->sync([$request->role]);
        $user->usermetas()->update([
            'dateofbirth' => $request->dateofbirth,
            'address' => $request->address,
            'telp_no' => $request->telp_no,
            'parent_telp_no' => $request->parent_telp_no
        ]);

        \Flash::success('User diperbaharui.');
        return redirect()->route('users.edit', [$id]);
    }
    
    public function destroy($id)
    {
        User::find($id)->delete();

        \Flash::success('User dipindahkan ke Tong Sampah.');
        return redirect()->route('users.index');
    }

    public function trash(Request $request)
    {
        $users = User::onlyTrashed()->paginate(7);
        $querystring = $this->buildQueryString($request);
        $page_title = $request->has('q') ? 'Pencarian ' . $request->get('q') : 'Tong Sampah';
        
        return view('users.index', compact('users', 'querystring', 'page_title'));
    }

    public function restore($id)
    {
        User::where('id', $id)->restore();

        \Flash::success('Data dikembalikan.');
        return redirect()->route('users.trash');
    }

    public function forceDelete($id)
    {
        User::where('id', $id)->forceDelete();

        \Flash::success('User terhapus.');
        return redirect()->route('users.trash');
    }
}
