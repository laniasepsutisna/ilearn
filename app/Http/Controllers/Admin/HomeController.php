<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Announcement;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Subject;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:staff');
    }

    public function index()
    {
        if(Auth::check()) {
            $users = User::orderBy('created_at', 'DESC')->paginate(5);
            $majors = Major::orderBy('created_at', 'DESC')->paginate(5);
            $subjects = Subject::orderBy('created_at', 'DESC')->paginate(5);
            $classrooms = Classroom::orderBy('created_at', 'DESC')->paginate(5);
            $announcements = Announcement::orderBy('created_at', 'DESC')->paginate(5);
            return view('admin.home.home', compact('users', 'majors', 'subjects', 'classrooms', 'announcements'));
        }

        return view('auth.login');
    }

    public function profile()
    {
        $user = User::where('username', Auth::user()->username)->first();
        $page_title = 'Profile';

        return view('admin.home.profile', compact('user', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'no_induk' => 'required|unique:users,no_induk,' . $user->id,
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
        ], [
            'required' => 'Kolom :attribute diperlukan!',
            'confirmed' => 'Kolom :attribute tidak cocok!'
        ]);

        $user = User::findOrFail($id);
        if( $request->has('password') ) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        \Flash::success('Password berhasil diperbaharui.');
        return redirect()->back();
    }
}
