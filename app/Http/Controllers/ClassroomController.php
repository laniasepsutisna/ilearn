<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::paginate(7);
        $page_title = 'Semua Kelas';
        return view('classrooms.index', compact('classrooms', 'page_title'));
    }

    public function create()
    {
        $classrooms = Classroom::paginate(7);
        $page_title = 'Tambah Kelas';
        return view('classrooms.create', compact('classrooms', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'grade' => 'required|integer',
            'major' => 'required|exists:majors',
            'subject' => 'required|exists:subjects'
        ]);

        $classroom = Classroom::create($request->all());

        \Flash::success('Kelas berhasil dibuat.');
        return redirect()->route('classrooms.edit', [$classroom->id]);
    }

    public function edit($id)
    {
        $classrooms = Classroom::paginate(7);
        $classroom = Classroom::find($id);
        $page_title = 'Manage Kelas';

        return view('classrooms.edit', compact('classrooms', 'classroom', 'page_title'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'grade' => 'required|integer',
            'major' => 'required|exists:majors',
            'subject' => 'required|exists:subjects'
        ]);

        $classroom = Classroom::create($request->all());

        \Flash::success('Kelas berhasil diubah.');
        return redirect()->route('classrooms.edit', [$classroom->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
