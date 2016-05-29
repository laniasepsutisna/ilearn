<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class HomeController extends Controller
{
	public function index()
	{
		return view('user.global.feeds');
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
}
