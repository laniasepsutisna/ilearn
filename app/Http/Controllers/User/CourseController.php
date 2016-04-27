<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('created_at', 'DESC')->paginate(7);
        $page_title = 'Perpustakaan - Materi';

        return view('user.courses.index', compact('courses', 'page_title'));
    }

    public function create()
    {
        $page_title = 'Buat Materi Baru';
        return view('user.courses.create', compact('page_title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'teacher_id' => 'required|exists:users,id',
            'name' => 'required',
            'level' => 'required',
            'picture' => 'required|max:1000|mimes:jpg,jpeg,png,bmp,gif',
            'description' => 'required'
        ], [
            'required' => 'Kolom :attribute diperlukan',
        ]);

        $course = Course::create($request->all());

        \Flash::success('Tugas berhasil ditambahkan.');

        return redirect()->route('courses.edit', $course);
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $page_title = 'Buat Materi Baru';
        return view('user.courses.edit', compact('page_title', 'course'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
