<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
	public function index(Request $request)
	{
		$majors = Major::where('name', 'LIKE', '%' . $request->q . '%')
			->orWhere('description', 'LIKE', '%' . $request->q . '%')
			->orderBy('created_at', 'DESC')
			->paginate(7);
		$page_title = 'Semua Jurusan';

		return view('admin.majors.index', compact('majors', 'page_title'));
	}

	public function create()
	{
		$majors = Major::orderBy('created_at', 'DESC')->paginate(7);
		$page_title = 'Tambah Jurusan';

		return view('admin.majors.create', compact('majors', 'page_title'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan!'
		]);

		$major = Major::create($request->all());

		\Flash::success('Jurusan berhasil ditambah.');
		return redirect()->route('lms-admin.majors.edit', [$major->id]);
	}

	public function edit($id)
	{
		$major = Major::findOrFail($id);
		$majors = Major::orderBy('created_at', 'DESC')->paginate(7);
		$page_title = 'Edit Jurusan';

		return view('admin.majors.edit', compact('majors', 'major', 'page_title'));
	}

	public function update(Request $request, $id)
	{
		$major = Major::find($id);
		
		$this->validate($request, [
			'name' => 'required',
			'description' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan!'
		]);

		$major->update($request->all());

		\Flash::success('Jurusan berhasil diubah.');
		return redirect()->back();
	}

	public function destroy($id)
	{
		Major::find($id)->delete();

		\Flash::success('Jurusan berhasil dihapus.');
		return redirect()->back();
	}
}
