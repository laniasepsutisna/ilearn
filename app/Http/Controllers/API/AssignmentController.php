<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
	public function deadline()
	{
		$data = [];
		$classrooms = Auth::user()->hasRole('teacher') ? Auth::user()->teacherclassrooms : Auth::user()->classrooms;

		$ids = $classrooms->map(function($class){
			return $class->id;
		})->toArray();

		$assignments = Assignment::whereHas('classrooms', function($q) use ($ids) {
			$q->where('deadline', '>', date('Y-m-d'));
			$q->whereIn('id', $ids);
		})
		->get();

		foreach($assignments as $key => $assignment) {
			$data[$key]['title'] = $assignment->title;
			foreach ($assignment->classrooms as $classroom) {
				$data[$key]['start'] = Carbon::parse($classroom->pivot->created_at)->format('Y-m-d H:i:s');
				$data[$key]['end'] = Carbon::parse($classroom->pivot->deadline)->format('Y-m-d H:i:s');
			}
		}

		return $data;
	}
}
