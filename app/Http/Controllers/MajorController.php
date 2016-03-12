<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::paginate(7);
        $page_title = 'Jurusan';

        return view('majors.index', compact('majors', 'page_title'));
    }

    public function create()
    {
        $majors = Major::paginate(7);
        $page_title = 'Tambah Jurusan';

        return view('majors.create', compact('majors', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => ''
        ]);

        $major = Major::create($request->all());

        \Flash::success('Jurusan berhasil ditambah.');
        return redirect()->route('majors.edit', [$major->id]);
    }

    public function edit($id)
    {
        $majors = Major::paginate(7);
        $major = Major::findOrFail($id);
        $page_title = 'Edit Jurusan';

        return view('majors.edit', compact('majors', 'major', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => ''
        ]);

        $major = Major::find($id);
        $major->update($request->all());

        \Flash::success('Jurusan berhasil diubah.');
        return redirect()->route('majors.edit', [$major->id]);
    }

    public function destroy($id)
    {
        Major::find($id)->delete();

        \Flash::success('Jurusan berhasil dihapus.');
        return redirect()->route('majors.index');
    }
}
