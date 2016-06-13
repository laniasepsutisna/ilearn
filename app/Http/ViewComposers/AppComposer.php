<?php

namespace App\Http\ViewComposers;

use App\Models\Announcement;
use App\Models\Assignment;
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
		$data['joined_class'] = $data['classrooms']->map(function($class){
			return $class->id;
		})->toArray();
		$data['assignments']   = $this->classAssignment($data['joined_class']);
		$data['announcements'] = Announcement::orderBy('created_at')->limit(5)->get();
		$data['online']        = User::onlineusers()->orderBy('created_at')->limit(5)->get();

		$view->with('lms', $data);
	}

	private function classAssignment($joined_class)
	{
		$assignments = Assignment::whereHas('classrooms', function($q) use ($joined_class) {
				$q->where('deadline', '>', date('Y-m-d'));
				$q->whereIn('id', $joined_class);
			})
			->limit(5)
			->get();

		return $assignments;
	}
}
