<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
	public function deadline()
	{
		$user = Auth::user();
		$data = [];

		if($user->hasRole('teacher')) {
			foreach($user->teacherclassrooms as $classroom){
					foreach($classroom->assignments as $index => $assignment) {
						$data[$index]['title'] = $assignment->title;
						$data[$index]['start'] = $assignment->pivot->created_at->format('Y-m-d H:i:s'); 
						$data[$index]['end'] = $assignment->pivot->deadline . ' 23:59:00'; 
						$data[$index]['allDay'] = false;
					}
			}
		}
		else {
			foreach($user->classrooms as $classroom){
					foreach($classroom->assignments as $index => $assignment) {
						$data[$index]['title'] = $assignment->title;
						$data[$index]['start'] = $assignment->pivot->created_at->format('Y-m-d H:i:s'); 
						$data[$index]['end'] = $assignment->pivot->deadline . ' 23:59:00'; 
						$data[$index]['allDay'] = false;
					}
			}
		}

		return $data;
	}
}
