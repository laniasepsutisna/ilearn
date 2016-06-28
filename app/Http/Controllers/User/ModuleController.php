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

		if($request->hasFile('file')) {
			$data['file'] = $this->upload($request->file('file'));
		}

		$course = Module::create($data);

		\Flash::success('Module berhasil ditambahkan.');

		return redirect()->back();
	}

	public function edit($id)
	{
		$page_title = 'Edit Modul';
		$module = Module::findOrFail($id);
		return view('user.courses.edit-module', compact('module', 'page_title'));
	}

	public function update(Request $request, $id)
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
		if($request->hasFile('file')) {
			$data['file'] = $this->upload($request->file('file'));
		}
		dd($data);
		$module = Module::findOrFail($id);
		$module->update($data);

		\Flash::success('Module berhasil diubah.');

		return redirect()->back();
	}

	public function destroy($id)
	{
		$module = Module::findOrFail($id);
		$file = public_path( 'uploads/courses/' . $module->file );

		if($module->file && file_exists($file)) {
			unlink( $file );
		}

		$module->delete();

		\Flash::success('Modul berhasil dihapus.');

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
