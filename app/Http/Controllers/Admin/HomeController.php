<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Announcement;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
	public function index()
	{
		$users = User::orderBy('created_at', 'DESC')->paginate(5);
		$majors = Major::orderBy('created_at', 'DESC')->paginate(5);
		$subjects = Subject::orderBy('created_at', 'DESC')->paginate(5);
		$classrooms = Classroom::orderBy('created_at', 'DESC')->paginate(5);
		$announcements = Announcement::orderBy('created_at', 'DESC')->paginate(5);
		
		return view('admin.home.home', compact('users', 'majors', 'subjects', 'classrooms', 'announcements'));
	}

	public function profile()
	{
		$user = Auth::user();
		$page_title = 'Profile';

		return view('admin.home.profile', compact('user', 'page_title'));
	}
}
