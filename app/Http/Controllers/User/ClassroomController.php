<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Classroom;
use App\Models\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    public function show($id)
    {
    	$classroom = Classroom::find($id);
    	$page_title = 'Kelas ' . $classroom->classname;

    	if(Auth::user()->id == $classroom->teacher_id || $this->isStudentIn($classroom, Auth::user()->id)) {
    		return view('user.classrooms.index', compact('classroom', 'page_title'));
    	}

		return abort(401);
    }

    private function isStudentIn($classroom, $user_id)
    {
    	foreach ($classroom->students as $student) {
    		if($student->id === $user_id) {
    			return true;
    		}
    	}
    	return false;
    }
}