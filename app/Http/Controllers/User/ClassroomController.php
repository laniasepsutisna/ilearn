<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Discussion;
use Carbon\Carbon;
use Gate;
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

    public function discussionDetail($classroom, $discuss)
    {
        $classroom  = Classroom::findOrFail($classroom);
        $discussion = Discussion::findOrFail($discuss);

        $page_title = 'Diskusi - Detail';

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.detail-discuss', compact('classroom', 'discussion', 'page_title'));
        }

        return abort(401);
    }

    public function assignmentDetail($classroom, $assignment_id)
    {
        $classroom  = Classroom::findOrFail($classroom);
        $assignment = Assignment::findOrFail($assignment_id);

        $due = $assignment->deadline->timezone('Asia/Makassar');
        $now = Carbon::now('Asia/Makassar');
        $deadline = $now->gte($due);

        $submit = $assignment->submissions->contains(Auth::user()->id);

        $page_title = $assignment->title;

        if (Gate::allows('member-of', $classroom)){
            return view('user.classrooms.detail-assignment', compact('classroom', 'assignment', 'submit', 'deadline', 'page_title'));
        }

        return abort(401);
    }

    public function createSubmission(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan'
        ]);

        Assignment::find($id)->submissions()
        ->attach(Auth::user()->id, [
            'title' => $request->title,
            'file' => $request->file,
            'content' => $request->content
        ]);

        return redirect()->back();
    }

    public function updateSubmission(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan'
        ]);

        // update

        return redirect()->back();
    }

    public function download($filename)
    {
        if($filename) {
            $pathToFile = public_path('uploads/files/' . $filename);

            return response()->download($pathToFile, null, [], null);
        }

        return abort(500);
    }
}
