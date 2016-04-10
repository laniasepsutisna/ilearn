<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\User;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        $classrooms = Classroom::orderBy('created_at', 'DESC')->paginate(7);
        $page_title = 'Semua Kelas';
        return view('admin.classrooms.index', compact('classrooms', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Tambah Kelas';
        return view('admin.classrooms.create', compact('classrooms', 'page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'grade' => 'required',
            'major_id' => 'required|exists:majors,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required',
            'description' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan!',
            'exists' => 'Kolom :attribute tidak ditemukan!'
        ]);

        $classroom = Classroom::create($request->all());

        \Flash::success('Kelas berhasil dibuat.');
        return redirect()->route('lms-admin.classrooms.edit', [$classroom->id]);
    }

    public function edit($id)
    {
        $classroom = Classroom::findOrFail($id);
        $students = $classroom->students()->where('role', 'student')->paginate(5, ['*'], 's_page');
        $page_title = 'Manage Kelas';

        $ids = $classroom->students->pluck('id');

        return view('admin.classrooms.edit', compact('classroom', 'page_title', 'students', 'ids'));
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);

        $this->validate($request, [
            'grade' => 'required',
            'major_id' => 'required|exists:majors,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:users,id',
            'description' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan!',
            'exists' => 'Kolom :attribute tidak ditemukan!'
        ]);

        $classroom->update($request->all());

        \Flash::success('Kelas berhasil diubah.');
        return redirect()->back();
    }

    public function destroy($id)
    {
        Classroom::findOrFail($id)->delete();

        \Flash::success('Kelas berhasil dihapus.');
        return redirect()->back();
    }

    public function addMembers(Request $request)
    {
        $this->validate($request, [
            'students' => 'required|exists:users,id'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong!',
            'exists' => 'Kolom :attribute tidak ditemukan!'
        ]);

        $classroom = Classroom::findOrFail($request->classroom_id);
        $classroom->students()->sync($request->students, false);

        \Flash::success('Member berhasil ditambahkan.');
        return redirect()->back();
    }

    public function removeMember(Request $request, $id) {

        $classroom = Classroom::findOrFail($request->classroom_id);
        $classroom->students()->detach($id);

        \Flash::success('User berhasil dihapus dari kelas.');
        return redirect()->back();
    }
}
