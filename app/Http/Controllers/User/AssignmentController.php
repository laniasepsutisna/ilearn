<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Activity;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AssignmentController extends Controller
{
	public function index(Request $request)
	{
		$assignments = $request->user()
			->teacherassignments()
			->orderBy('created_at', 'DESC')
			->paginate(7);
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

		$assignment = $request->user()
			->teacherassignments()
			->create($data);

		\Flash::success('Tugas berhasil ditambahkan.');

		return redirect()->route('assignments.edit', $assignment);
	}

	public function edit(Request $request, $id)
	{
		$assignment = $request->user()
			->teacherassignments()
			->where('id', $id)
			->first();
		$ids = $assignment->attachedTo;
		$attached = $assignment->attachedClassroom;

		$page_title = $assignment->title;

		return view('user.assignments.edit', compact('assignment', 'page_title', 'attached', 'ids'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'title' => 'required',
			'file' => 'max:10000|mimes:pdf,docx,doc,zip',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = $request->user()
			->teacherassignments()
			->where('id', $id)
			->first();
		$data = $request->except('file');
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

	public function destroy(Request $request, $id)
	{
		$assignment = $request->user()
			->teacherassignments()
			->where('id', $id)
			->first();
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
			'classroom_id' => 'required|exists:classrooms,id',
			'assignment_id' => 'required|exists:assignments,id',
			'deadline' => 'required',
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$assignment = Assignment::findOrFail($request->assignment_id);

		Activity::create([
			'teacher_id' => $request->user()->id,
			'classroom_id' => $request->classroom_id,
			'action' => 'Membagikan tugas ke ',
			'route' => 'classrooms.assignmentdetail',
			'detail' => $assignment->id
		]);

		$assignment->classrooms()
			->sync([$request->classroom_id => ['deadline' => $request->deadline]], false);

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

		Assignment::findOrFail($request->assignment_id)
			->classrooms()
			->detach($request->classroom_id);

		\Flash::success('Tugas berhasil batalkan.');

		return redirect()->back();
	}

	public function upload(UploadedFile $file)
	{
		$original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
		$sanitize = preg_replace('/[^a-zA-Z0-9]+/', '-', $original);
		$fileName = $sanitize . '.' . $file->getClientOriginalExtension();
		$destination = public_path() . DIRECTORY_SEPARATOR . 'uploads/assignments';

		$uploaded = $file->move($destination, $fileName);

		return $fileName;
	}

	public function assignments(Request $request)
	{
		$classrooms = $request->user()->hasRole('teacher') ? $request->user()->teacherclassrooms : $request->user()->classrooms;
		$page_title = 'Semua Tugas';
		$ids = $classrooms->map(function($class){
			return $class->id;
		})->toArray();

		$assignments = Assignment::whereHas('classrooms', function($q) use ($ids) {
			$q->where('deadline', '>=', date('Y-m-d'));
			$q->whereIn('id', $ids);
		})->paginate(10);

  	return view('user.global.assignments', compact('assignments', 'page_title'));
	}
}
