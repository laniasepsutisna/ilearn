<?php

namespace App\Http\ViewComposers;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Auth;

class AppComposer
{
	public function compose(View $view)
	{
		$joined_class = Auth::user()->joinedClassrooms;
		$data = [];

		$data['profile']       = Auth::user();
		$data['classrooms']    = Classroom::find($joined_class);
		$data['assignments']   = $this->classAssignment($joined_class);
		$data['online']        = User::onlineusers()->limit(8)->get();

		$view->with('lms', $data);
	}

	private function classAssignment($joined_class)
	{
		$assignments = Assignment::with('classrooms')->whereHas('classrooms', function($q) use ($joined_class) {
				$q->where('deadline', '>', date('Y-m-d'));
				$q->whereIn('id', $joined_class);
			})
			->limit(5)
			->get();

		return $assignments;
	}
}
