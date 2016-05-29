<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Quiz;
use Illuminate\Http\Request;

class MultipleChoiceController extends Controller
{
	public function create($quiz_id)
	{
		$quiz = Quiz::findOrFail($quiz_id);
		$page_title = 'Tambahkan Pertanyaan';
		
		return view('user.quizzes.create-mc', compact('quiz', 'page_title'));
	}

	public function store(Request $request, $quiz_id)
	{
		$this->validate($request, [
			'questions.*.question' => 'required',
			'questions.*.image' => 'max:1000|mimes:jpg,jpeg,png,bmp',
			'questions.*.answers.answer_1' => 'required',
			'questions.*.answers.answer_2' => 'required',
			'questions.*.answers.answer_3' => 'required',
			'questions.*.answers.answer_4' => 'required'
		]);

		foreach ($request->questions as $questions) {
			$quiz = Quiz::findOrFail($quiz_id);
			$question = $quiz->multiplechoices()->create($questions);
			$question->answers()->create($questions['answers']);

			// TODO: Save video & Upload image
		}

		\Flash::success('Quiz berhasil disimpan.');

		return redirect()->route('quizzes.edit', $quiz->id);
	}

	public function edit($quiz_id)
	{
		$quiz = Quiz::findOrFail($quiz_id);
		$page_title = $quiz->title;
		$questions = $quiz->questions;

		return view('user.quizzes.edit-mc', compact('quiz', 'page_title', 'questions'));
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
