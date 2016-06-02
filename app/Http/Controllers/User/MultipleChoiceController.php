<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Quiz;
use Illuminate\Http\Request;

class MultipleChoiceController extends Controller
{
	public function create($quizId)
	{
		$quiz = Quiz::findOrFail($quizId);
		$page_title = 'Tambahkan Pertanyaan';
		
		return view('user.quizzes.create-mc', compact('quiz', 'page_title'));
	}

	public function store(Request $request, $quizId)
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
			$quiz = Quiz::findOrFail($quizId);
			$question = $quiz->multiplechoices()->create($questions);
			$question->answer()->create($questions['answers']);

			// TODO: Save uploaded image
		}

		\Flash::success('Quiz berhasil disimpan.');

		return redirect()->route('quizzes.edit', $quiz->id);
	}

	public function edit($quizId, $questionId)
	{
		$quiz = Quiz::findOrFail($quizId);
		$page_title = $quiz->title;

		if($quiz->type === 'multiple_choice') {
			$question = $quiz->multiplechoices()->where('id', $questionId)->first();
		} else {
			$question = []; // TODO: Essay type
		}

		return view('user.quizzes.edit-mc', compact('quiz', 'page_title', 'question'));
	}

	public function update(Request $request, $quizId, $questionId)
	{
		$this->validate($request, [
			'question' => 'required',
			'image' => 'max:1000|mimes:jpg,jpeg,png,bmp',
			'answer_1' => 'required',
			'answer_2' => 'required',
			'answer_3' => 'required',
			'answer_4' => 'required'
		]);

		$quiz = Quiz::findOrFail($quizId);
		if($quiz->type === 'multiple_choice') {
			$question = $quiz->multiplechoices()->where('id', $questionId)->first();
			$question->update([
				'question' => $request->question,
				'image' => $request->image
			]);

			$question->answer()
				->update([
					'answer_1' => $request->answer_1,
					'answer_2' => $request->answer_2,
					'answer_3' => $request->answer_3,
					'answer_4' => $request->answer_4
				]);
		} else {
			// TODO: Essay
		}

		\Flash::success('Pertanyaan berhasil diubah.');

		return redirect()->back();
	}

	public function destroy($quizId, $questionId)
	{
		$quiz = Quiz::findOrFail($quizId);

		if($question->type === 'multiple_choice') {
			$question = $quiz->multiplechoices()->where('id', $questionId)->first();
			$file = public_path( 'uploads/quizzes/' . $question->image );
			
			if($question->image && file_exists($file)) {
				unlink($file);
			}

			$question->delete();
		} else {
			// TODO: Essay
		}

		\Flash::success('Pertanyaan berhasil dihapus.');

		return redirect()->back();
	}
}
