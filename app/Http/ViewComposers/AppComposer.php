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

		$data['profile']       = Auth::user();
		$data['classrooms']    = Auth::user()->hasRole('teacher') ? Auth::user()->teacherclassrooms : Auth::user()->classrooms;
		$data['assignments']   = $this->classAssignment($data['classrooms']);
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
