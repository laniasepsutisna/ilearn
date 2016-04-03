<?php

namespace App\Http\ViewComposers;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class SidebarComposer
{
	
	public function compose(View $view) {
		$data = [];

		$data['profile'] = Auth::user();
		$data['online'] = User::where('login', 1)->where('role', '<>', 'staff')->orderBy('firstname')->limit(10)->get();
		$data['classrooms'] = User::find(Auth::user()->id)->classrooms;
		$data['announcements'] = Announcement::orderBy('created_at')->limit(5)->get();
		$view->with('lms', $data);
	}
}