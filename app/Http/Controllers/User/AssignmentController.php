<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AssignmentController extends Controller
{
	public function index()
	{
		$assignments = Assignment::where('teacher_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(7);
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
			'teacher_id' => 'required|exists:users,id',
			'title' => 'required',
			'file' => 'max:10000|mimes:pdf,docx,doc,zip',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan',
		]);

		$data = $request->except('file');

		if($request->hasFile('file')) {
			$data['file'] = $this->upload($request->file('file'));
		}

		$assignment = Assignment::create($data);

		\Flash::success('Tugas berhasil ditambahkan.');

		return redirect()->route('assignments.edit', $assignment);
	}

	public function edit($id)
	{
		$assignment = Assignment::findOrFail($id);
		$ids = $assignment->attachedTo;
		$attached = $assignment->attachedClassroom;

		$page_title = $assignment->title;

		return view('user.assignments.edit', compact('assignment', 'page_title', 'attached', 'ids'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'teacher_id' => 'required',
			'title' => 'required',
			'file' => 'max:10000|mimes:pdf,docx,doc,zip',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$data = $request->except('file');
		$assignment = Assignment::findOrFail($id);
		$file = public_path( 'uploads/assignments/' . $assignment->file );

		if($request->hasFile('file')) {
			if(file_exists($file) && $assignment->file !== '') {
				unlink( $file );
			}

			$data['file'] = $this->upload($request->file('file'));
		}

		$assignment->update($data);

		\Flash::success('Tugas berhasil diupdate.');

		return redirect()->back();
	}

	public function destroy($id)
	{
		$assignment = Assignment::findOrFail($id);
		$file = public_path( 'uploads/assignments/' . $assignment->file );
		
		if($assignment->file && file_exists($file)) {
			unlink( $file );
		}

		$assignment->delete();

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

	public function detachFrom(Request $request)
	{
		$this->validate($request, [
			'classroom_id' => 'required',
			'assignment_id' => 'required',
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = Assignment::findOrFail($request->assignment_id);
		$assignment->classrooms()->detach($request->classroom_id);

		\Flash::success('Tugas berhasil batalkan.');

		return redirect()->back();
	}

	public function upload(UploadedFile $file)
	{
		$original = pathinfo( $file->getClientOriginalName(), PATHINFO_FILENAME );
		$sanitize = preg_replace('/[^a-zA-Z0-9]+/', '-', $original);
		$fileName = $sanitize . '.' . $file->getClientOriginalExtension();
		$destination = public_path() . DIRECTORY_SEPARATOR . 'uploads/assignments';

		$uploaded = $file->move($destination, $fileName);

		return $fileName;
	}
}
