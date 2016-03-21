<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:staff');
    }

    public function index(Request $request)
    {
        $subjects = Subject::where('name', 'LIKE', '%' . $request->q . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->q . '%')
                    ->orderBy('created_at', 'DESC')->paginate(7);
        $page_title = 'Mata Pelajaran';

        return view('admin.subjects.index', compact('subjects', 'page_title'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('created_at', 'DESC')->paginate(7);
        $page_title = 'Tambah Mata Pelajaran';

        return view('admin.subjects.create', compact('subjects', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan!'
        ]);

        $subject = Subject::create($request->all());

        \Flash::success('Mata pelajaran berhasil ditambah.');
        return redirect()->route('lms-admin.subjects.edit', [$subject->id]);
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $subjects = Subject::orderBy('created_at', 'DESC')->paginate(7);
        $page_title = 'Edit Mata Pelajaran';

        return view('admin.subjects.edit', compact('subjects', 'subject', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::find($id);

        $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan!'
        ]);

        $subject->update($request->all());

        \Flash::success('Mata pelajaran berhasil diubah.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Subject::find($id)->delete();

        \Flash::success('Mata pelajaran berhasil dihapus.');
        return redirect()->back();
    }
}
