<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
	public function index()
	{
		$courses = Course::orderBy('created_at', 'DESC')->paginate(7);
		$page_title = 'Perpustakaan - Materi';

		return view('user.courses.index', compact('courses', 'page_title'));
	}

	public function create()
	{
		$page_title = 'Buat Materi Baru';
		return view('user.courses.create', compact('page_title'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'teacher_id' => 'required|exists:users,id',
			'name' => 'required',
			'level' => 'required',
			'picture' => 'required|max:1000|mimes:jpg,jpeg,png,bmp',
			'description' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan',
		]);

		$data = $request->except('picture');
		$data['picture'] = $this->upload($request->file('picture'));

		$course = Course::create($data);


		\Flash::success('Tugas berhasil ditambahkan.');

		return redirect()->route('courses.edit', $course);
	}

	public function edit($id)
	{
		$course = Course::findOrFail($id);
		$page_title = 'Buat Materi Baru';
		return view('user.courses.edit', compact('page_title', 'course'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'teacher_id' => 'required|exists:users,id',
			'name' => 'required',
			'level' => 'required',
			'picture' => 'required|max:1000|mimes:jpg,jpeg,png,bmp',
			'description' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan',
		]);

		$data = $request->except('picture');
		$data['picture'] = $this->upload($request->file('picture'));

		$course = Course::findOrFail($id);
		$course->update($data);

		\Flash::success('Tugas berhasil diupdate.');

		return redirect()->back();
	}

	public function destroy($id)
	{
		$course = Course::findOrFail($id);
		$picture = public_path( 'uploads/courses/' . $course->picture );

		if($course->picture && file_exists($picture)) {
			unlink( $picture );
		}

		$course->delete();

		\Flash::success('Materi berhasil dihapus.');

		return redirect()->back();
	}

	public function upload(UploadedFile $picture)
	{
		$original = pathinfo( $picture->getClientOriginalName(), PATHINFO_FILENAME );
		$sanitize = preg_replace('/[^a-zA-Z0-9]+/', '-', $original);
		$fileName = $sanitize . '.' . $picture->getClientOriginalExtension();
		$destination = public_path() . DIRECTORY_SEPARATOR . 'uploads/courses';

		$uploaded = $picture->move($destination, $fileName);

		Image::make($uploaded)->fit(300,300)->save($destination . '/300x300-' . $fileName);

		return $fileName;
	}
}
