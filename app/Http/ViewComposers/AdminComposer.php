<?php

namespace App\Http\ViewComposers;

use App\Models\Announcement;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Subject;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class AdminComposer
{
	
	public function compose(View $view)
	{
		$data = [];
		$data['profile']    = Auth::user();
		$data['majors']     = Major::all();
		$data['subjects']   = Subject::all();
		$data['classrooms'] = Classroom::all();
		
		$view->with('lms', $data);
	}
}