<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Classroom;
use App\Models\Discussion;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function show($id)
    {
    	$classroom = Classroom::find($id);
    	$members = $classroom->users;
    	$page_title = 'Kelas ' . $classroom->classname;
    	
    	return view('user.classrooms.index', compact('classroom', 'members', 'page_title'));
    }
}