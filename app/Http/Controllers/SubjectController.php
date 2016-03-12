<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::paginate(7);
        $page_title = 'Mata Pelajaran';

        return view('subjects.index', compact('subjects', 'page_title'));
    }

    public function create()
    {
        $subjects = Subject::paginate(7);
        $page_title = 'Tambah Mata Pelajaran';

        return view('subjects.create', compact('subjects', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => ''
        ]);

        $subject = Subject::create($request->all());

        \Flash::success('Mata pelajaran berhasil ditambah.');
        return redirect()->route('subjects.edit', [$subject->id]);
    }

    public function edit($id)
    {
        $subjects = Subject::paginate(7);
        $subject = Subject::findOrFail($id);
        $page_title = 'Edit Mata Pelajaran';

        return view('subjects.edit', compact('subjects', 'subject', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => ''
        ]);

        $subject = Subject::find($id);
        $subject->update($request->all());

        \Flash::success('Mata pelajaran berhasil diubah.');
        return redirect()->route('subjects.edit', [$subject->id]);
    }

    public function destroy($id)
    {
        Subject::find($id)->delete();

        \Flash::success('Mata pelajaran berhasil dihapus.');
        return redirect()->route('subjects.index');
    }
}
