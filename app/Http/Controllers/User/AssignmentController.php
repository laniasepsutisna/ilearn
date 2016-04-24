<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
	public function index()
	{
		$assignments = Assignment::where('user_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(7);
		$page_title = 'Perpustakaan - Tugas';

		return view('user.assignments.index', compact('assignments','page_title'));
	}

	public function create()
	{
		$page_title = 'Tugas Baru';

		return view('user.assignments.create', compact('page_title'));		
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'title' => 'required',
			'file' => 'mimes:jpeg,png,doc,docx,pdf,xls,xlsx,ppt,pptx',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = Assignment::create($request->all());

		\Flash::success('Tugas berhasil ditambahkan.');

		return redirect()->route('assignments.edit', $assignment);
	}

	public function edit($id)
	{
		$assignment = Assignment::findOrFail($id);
		$ids = $assignment->attachedTo;
		$attached = $assignment->attachedClassroom;

		$page_title = 'Tugas Baru';

		return view('user.assignments.edit', compact('assignment', 'page_title', 'attached', 'ids'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'user_id' => 'required',
			'title' => 'required',
			'file' => 'mimes:jpeg,png,doc,docx,pdf,xls,xlsx,ppt,pptx',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = Assignment::findOrFail($id);

		$assignment->update($request->all());

		\Flash::success('Tugas berhasil diupdate.');

		return redirect()->back();
	}

	public function destroy($id)
	{
		Assignment::findOrFail($id)->delete();

		\Flash::success('Tugas berhasil dihapus.');

		return redirect()->back();
	}

	public function attachTo(Request $request)
	{
		$this->validate($request, [
			'classrooms' => 'required',
			'deadline' => 'required',
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$data = [];
		$assignment = Assignment::findOrFail($request->assignment_id);

		foreach ($request->classrooms as $class) {
			$data[$class] = ['deadline' => $request->deadline];
		}

		$assignment->classrooms()->sync($data, false);

		\Flash::success('Tugas berhasil dibagikan.');

		return redirect()->back();
	}

	public function detachFrom(Request $request, $id)
	{
		$this->validate($request, [
			'assignment_id' => 'required',
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = Assignment::findOrFail($request->assignment_id);
		$assignment->classrooms()->detach($id);


		\Flash::success('Tugas berhasil batalkan.');

		return redirect()->back();
	}
}
