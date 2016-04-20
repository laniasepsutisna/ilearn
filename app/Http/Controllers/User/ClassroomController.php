<?php

namespace App\Http\Controllers\User;

use Gate;
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
    	$classroom = Classroom::findOrFail($id);
    	$page_title = 'Kelas ' . $classroom->classname;

    	if (Gate::allows('member-of', $classroom)){
    		return view('user.classrooms.index', compact('classroom', 'page_title'));
        }

		return abort(401);
    }

    public function courses($id)
    {
        $classroom = Classroom::findOrFail($id);
        $page_title = 'Materi - Kelas ' . $classroom->classname;

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.courses', compact('classroom', 'page_title'));
        }

        return abort(401);
    }

    public function assignments($id)
    {
        $classroom = Classroom::findOrFail($id);
        $page_title = 'Tugas - Kelas ' . $classroom->classname;

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.assignments', compact('classroom', 'page_title'));
        }

        return abort(401);
    }

    public function quizes($id)
    {
        $classroom = Classroom::findOrFail($id);
        $page_title = 'Quiz - Kelas ' . $classroom->classname;

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.quizes', compact('classroom', 'page_title'));
        }

        return abort(401);
    }

    public function members($id)
    {
        $classroom = Classroom::findOrFail($id);
        $page_title = 'Anggota - Kelas ' . $classroom->classname;

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.members', compact('classroom', 'page_title'));
        }

        return abort(401);
    }

    public function download($filename)
    {   
        if($filename) {
            $pathToFile = public_path('uploads/files/' . $filename);

            return response()->download($pathToFile, null, [], null);
        }

        return abort(500);
    }

    public function discussionDetail($classroom, $discussion)
    {
        $discussion = Classroom::findOrFail($classroom)
            ->discussions()->where('id', $discussion);

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.members', compact('classroom', 'page_title'));
        }

        return abort(401);
    }
}