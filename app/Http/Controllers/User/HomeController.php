<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Activity;
use App\Models\Discussion;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
	public function index()
	{
		$classroomIds = Auth::user()->joinedClassrooms;
		$activities = Activity::whereIn('classroom_id', $classroomIds)->orderBy('created_at', 'DESC')->paginate(10);
		$discussions = Discussion::where('parent_id', '')->whereIn('classroom_id', $classroomIds)->orderBy('created_at', 'DESC')->paginate(10);

		return view('user.global.feeds', compact('activities', 'discussions'));
	}

	public function profile()
	{
		$page_title = 'Profil';

		return view('user.global.profile', compact('page_title'));
	}

	public function password()
	{
		$page_title = 'Password';

		return view('user.global.password', compact('page_title'));
	}

	public function calendar()
	{
		$page_title = 'Kalender';

		return view('user.global.calendar', compact('page_title'));
	}

	public function online()
	{
		$users = User::onlineusers()->get();
		$page_title = 'Online';

		return view('user.global.onlines', compact('page_title', 'users'));
	}

	public function friend($username)
	{
		$user = User::where('username', $username)->first();
		$page_title = $user->fullname;

		return view('user.global.friend', compact('page_title', 'user'));
	}
}
