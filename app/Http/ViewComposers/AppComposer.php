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

		$data['profile'] = Auth::user();

		if( Auth::user()->hasRole('teacher') ) {
			$data['classrooms']  = Auth::user()->teacherclassrooms;
		} else {
			$data['classrooms'] = Auth::user()->classrooms;
		}

		$data['assignments']   = $this->classAssignment($data['classrooms']);
		//$data['courses']       = Auth::user()->teachercourses;
		$data['announcements'] = Announcement::orderBy('created_at')->limit(5)->get();
		$data['online']        = User::onlineusers()->orderBy('created_at')->limit(5)->get();

		$view->with('lms', $data);
	}

	private function classAssignment($classrooms)
	{
		$data = [];
		foreach ($classrooms as $class) {
			foreach ($class->showFiveAssignments as $assigment) {
				$data[$assigment->id] = $assigment;
			}
		}

		return $data;
	}
}
