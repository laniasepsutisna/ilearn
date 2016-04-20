<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
	public function index()
	{
		$assignments = Assignment::where('user_id', Auth::user()->id)->get();
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

		return redirect()->route('assignments.index');
	}
}
