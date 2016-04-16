<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
	public function store(Request $request)
	{
		$this->validate($request, [
			'classroom_id' => 'required',
			'user_id' => 'required',
			'deadline' => 'required',
			'title' => 'required',
			'file' => 'mimes:jpeg,png,doc,docx,pdf,xls,xlsx,ppt,pptx',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = Assignment::create($request->except(['deadline']));

		$assignment->addAssignments($request->classroom_id, $request->deadline);

		return redirect()->back();
	}

	public function show($id)
	{
		$assignment = Assignment::findOrFail($id);
		$page_title = $assignment->title;
		$submit = $assignment->submissions->contains(Auth::user()->id);
		$due = $assignment->deadline->timezone('Asia/Makassar');
		$now = Carbon::now('Asia/Makassar');

		$deadline = $now->gte($due);

		return view('user.assignments.index', compact('assignment', 'page_title', 'submit', 'deadline'));
	}

	public function createsubmission(Request $request, $id)
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

	public function updatesubmission(Request $request, $id)
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
}
