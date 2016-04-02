<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(20);
        return $users;
    }

    public function teachers()
    {
        $teachers = User::where('role', 'teacher')->paginate(20);

        return $teachers;
    }

    public function students()
    {
        $students = User::where('role', 'student')->paginate(20);

        return $students;
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return $user;
    }

    public function profile()
    {
        if(! Auth::check()) {
            return response()->json(['status' => 403, 'message' => 'Access Forbidden'], 403);
        }

        $user = User::find(Auth::user()->id);
        return $user;
    }

    public function updateProfile(Request $request)
    {
        if(! Auth::check()) {
            return abort(403);
        }

        $this->validate($request, [
            'id' => 'required|string'
        ]);

        $user = User::find($id);
        $user->update($request->all());

        return response()->json(['status' => 200, 'message' => 'Profil berhasil diupdate.'], 200);
    }

    public function updatePassword(Request $request)
    {
        if(! Auth::check()) {
            return response()->json(['status' => 403, 'message' => 'Access Forbidden'], 403);
        }
        
        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan!',
            'confirmed' => 'Kolom :attribute tidak cocok!'
        ]);

        $user = User::findOrFail($id);

        if( $request->has('password') ) {
            $user->update(['password' => bcrypt($request->password)]);
            return response()->json(['status' => 200, 'message' => 'Profil berhasil diupdate.'], 200);
        }
    }

}
