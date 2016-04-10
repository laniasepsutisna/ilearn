<?php

namespace App\Http\ViewComposers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class AppComposer
{
	
	public function compose(View $view)
	{
		$data = [];
		$user_id = Auth::user()->id;

		$data['profile'] = Auth::user();
		$data['classrooms'] = User::find($user_id)->classrooms;
		$data['announcements'] = Announcement::orderBy('created_at')->limit(5)->get();
		$data['online'] = User::where(function($query) use ($user_id){
			$query->where('login', 1)->where('id', '<>', $user_id)->where('role', '<>', 'staff');
		})->orderBy('firstname')->limit(10)->get();
		
		$view->with('lms', $data);
	}
}