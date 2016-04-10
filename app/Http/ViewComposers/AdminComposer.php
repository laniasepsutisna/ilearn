<?php

namespace App\Http\ViewComposers;

use App\Models\Announcement;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

class AdminComposer
{
	
	public function compose(View $view)
    {
        $data = [];
		$user_id = Auth::user()->id;

		$data['profile'] = User::find($user_id);

        // $data['users'] = collect(User::all())->chunk(30)->toArray();
        $data['majors'] = Major::all();
        $data['subjects'] = Subject::all();
        $data['classrooms'] = Classroom::all();
        // $data['announcements'] = collect(Announcement::all())->chunk(100)->toArray();
		
		$view->with('lms', $data);
	}
}