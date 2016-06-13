<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Activity;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
	public function index()
	{
		$quizzes = Quiz::where('teacher_id', Auth::user()->id)->paginate(7);
		$page_title = 'Perpustakaan - Quiz';

		return view('user.quizzes.index', compact('page_title', 'quizzes'));
	}

	public function create()
	{
		$page_title = 'Quiz Baru';

		return view('user.quizzes.create', compact('page_title'));
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'teacher_id' => 'required|exists:users,id',
			'time_limit' => 'required'
		], [
			'required' => 'Kolom :attribute: diperlukan'
		]);

		$quiz = Quiz::create($request->all());

		\Flash::success('Quiz berhasil dibuat.');

		return redirect()->route('quizzes.edit', $quiz);
	}

	public function edit($id)
	{
		$quiz = Quiz::findOrFail($id);
		$ids = $quiz->attachedTo;

		$page_title = $quiz->title;

		return view('user.quizzes.edit', compact('page_title', 'quiz', 'ids'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'teacher_id' => 'required|exists:users,id',
			'time_limit' => 'required'
		], [
			'required' => 'Kolom :attribute: diperlukan'
		]);

		$quiz = Quiz::findOrFail($id);
		$quiz->update($request->all());

		\Flash::success('Quiz berhasil diubah.');

		return redirect()->back();
	}

	public function destroy($id)
	{
		Quiz::findOrFail($id)->delete();

		\Flash::success('Quiz berhasil dihapus.');

		return redirect()->back();
	}

	public function attachTo(Request $request)
	{
		$this->validate($request, [
			'classrooms' => 'required',
			'quiz_id' => 'required',
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$quiz = Quiz::findOrFail($request->quiz_id);

		foreach ($request->classrooms as $class) {
			Activity::create([
				'teacher_id' => Auth::user()->id,
				'classroom_id' => $class,
				'action' => 'Membagikan quiz ke ',
				'route' => 'classrooms.quizdetail',
				'detail' => $quiz->id
			]);
		}

		$quiz->classrooms()->sync($request->classrooms, false);

		\Flash::success('Quiz berhasil dibagikan.');

		return redirect()->back();
	}

	public function detachFrom(Request $request)
	{
		$this->validate($request, [
			'classroom_id' => 'required',
			'quiz_id' => 'required',
		], [
			'required' => 'Kolom :attribute diperlukan'
		]);

		$quiz = Quiz::findOrFail($request->quiz_id);
		$quiz->classrooms()->detach($request->classroom_id);

		\Flash::success('Quiz berhasil batalkan.');

		return redirect()->back();
	}

}
