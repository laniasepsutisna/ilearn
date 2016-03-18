<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Classroom;
use App\Models\User;

class ClassroomController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('role:staff');
    }

    public function index(Request $request)
    {
        $classrooms = Classroom::paginate(7);
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
        $users = $classroom->users()->paginate(7);
        $page_title = 'Manage Kelas';

        $ids = [];
        foreach ($classroom->users as $user) {
            $ids[] = $user->id;
        }

        return view('admin.classrooms.edit', compact('classroom', 'page_title', 'users', 'ids'));
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::findOrFail($id);

        $this->validate($request, [
            'grade' => 'required',
            'major_id' => 'required|exists:majors,id',
            'subject_id' => 'required|exists:subjects,id',
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
        $classroom = Classroom::findOrFail($request->classroom_id);
        $data = $this->addingMembers($request);

        $classroom->users()->sync($data, false);

        \Flash::success('Member berhasil ditambahkan.');
        return redirect()->back();
    }

    public function addingMembers($request)
    {
        $data = [];
        $validation = [];
        $users = [];

        if($request->has('teachers-submit')) {
            $validation = ['teachers' => 'required|unique:classroom_user,user_id|exists:users,id'];
            $users = $request->teachers;
        } elseif($request->has('students-submit')) {
            $validation = ['students' => 'required|unique:classroom_user,user_id|exists:users,id'];
            $users = $request->students;
        }
        
        $this->validate($request, $validation, [
            'required' => 'Kolom :attribute tidak boleh kosong!',
            'unique' => 'Kolom :attribute sudah ada di kelas ini!',
            'exists' => 'Kolom :attribute tidak ditemukan!'
        ]);

        foreach ($users as $user) {
            $data[$user] = ['role' => $request->role]; 
        }

        return $data;
    }

    public function removeMember(Request $request, $id) {

        $classroom = Classroom::findOrFail($request->classroom_id);
        $classroom->users()->detach($id);

        \Flash::success('User berhasil dihapus dari kelas.');
        return redirect()->back();
    }
}
