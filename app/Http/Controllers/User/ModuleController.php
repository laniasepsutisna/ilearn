<?php

namespace App\Http\Controllers\User;

use App\Models\Module;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ModuleController extends Controller
{
	public function store(Request $request)
	{
		$this->validate($request, [
			'course_id' => 'required|exists:courses,id',
			'name' => 'required',
			'description' => 'required',
			'file' => 'max:10000|mimes:pdf'
		], [
			'required' => 'Kolom :attribute diperlukan',
		]);

		$data = $request->except('file');
		if($request->has('file')) {
			$data['file'] = $this->upload($request->file('file'));
		}

		$course = Module::create($data);

		\Flash::success('Module berhasil ditambahkan.');

		return redirect()->back();
	}

	public function upload(UploadedFile $file)
	{
		$original = pathinfo( $file->getClientOriginalName(), PATHINFO_FILENAME );
		$sanitize = preg_replace('/[^a-zA-Z0-9]+/', '-', $original);
		$fileName = $sanitize . '.' . $file->getClientOriginalExtension();
		$destination = public_path() . DIRECTORY_SEPARATOR . 'uploads/courses';

		$uploaded = $file->move($destination, $fileName);

		return $fileName;
	}
}
