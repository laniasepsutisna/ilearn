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
		$data['classrooms']    = Classroom::where('id', $joined_class)->get();
		$data['assignments']   = $this->classAssignment($joined_class);
		$data['online']        = User::onlineusers()->orderBy('created_at')->limit(5)->get();

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
