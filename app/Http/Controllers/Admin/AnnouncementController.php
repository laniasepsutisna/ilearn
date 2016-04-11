<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
	public function index(Request $request)
	{
		$q = $request->q;
		$announcements = Announcement::where('user_id', Auth::user()->id)
			->where(function($query) use ($q){
				$query->where('title', 'LIKE', '%' . $q . '%');
				$query->orWhere('content', 'LIKE', '%' . $q . '%');
			})->orderBy('created_at', 'DESC')->paginate(7);

		$page_title = $request->has('q') ? 'Pencarian ' . $q : 'Pengumuman';

		return view('admin.announcements.index', compact('q', 'announcements', 'page_title'));
	}

	public function create()
	{
		$announcements = Announcement::orderBy('created_at', 'DESC')->paginate(7);
		$page_title = 'Tambah Pengumuman';

		return view('admin.announcements.create', compact('announcements', 'page_title'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'title' => 'required|string|max:150|unique:announcements',
			'status' => 'required',
			'user_id' => 'exists:users,id',
			'content' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'unique' => 'Kolom :attribute sudah dipakai!',
			'max' => 'Kolom :attribute maksimal 150 karakter.',
			'exists' => 'Kolom :attribute tidak ditemukan!'
		]);

		$a = Announcement::create($request->all());
		
		\Flash::success('Pengumuman tersimpan.');
		return redirect()->route('lms-admin.announcements.edit', [$a->id]);
	}

	public function edit($id)
	{
		$announcements = Announcement::orderBy('created_at', 'DESC')->paginate(7);

		$announcement = Announcement::findOrFail($id);
		$page_title = 'Edit Pengumuman';

		return view('admin.announcements.edit', compact('announcements', 'announcement', 'page_title'));
	}

	public function update(Request $request, $id)
	{
		$announcement = Announcement::findOrFail($id);

		$this->validate($request, [
			'title' => 'required|string|max:100|unique:announcements,title,' . $announcement->id,
			'status' => 'required',
			'user_id' => 'exists:users,id',
			'content' => 'required|string'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'unique' => 'Kolom :attribute sudah dipakai!',
			'max' => 'Kolom :attribute maksimal 150 karakter.',
			'exists' => 'Kolom :attribute tidak ditemukan!'
		]);

		$announcement->update($request->all());

		\Flash::success('Pengumuman diperbaharui.');
		return redirect()->back();
	}
	
	public function destroy($id)
	{
		Announcement::find($id)->delete();

		\Flash::success('Pengumuman berhasil dihapus.');
		return redirect()->back();
	}
}
