<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;

class QuizController extends Controller
{
	public function startQuiz(Request $request)
	{
		$this->validate($request, [
			'classroom_id' => 'required|exists:classrooms,id',
			'quiz_id' => 'required|exists:quizzes,id'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'exists' => 'Kolom :attribute tidak ditemukan!'
		]);

		$quiz = Quiz::findOrFail($request->quiz_id);
		$isStarted = $quiz->students->contains(Auth::user()->id);
		$deadline = Carbon::now()->addMinutes($quiz->time_limit);

		if(!$isStarted) {
			$quiz->students()
				->sync([
					Auth::user()->id => ['time' => $deadline]
				], false);
		}

		return response()->json([
			'redirect' => route('classrooms.quizdetail', [$request->classroom_id, $request->quiz_id])
		]);
	}

	public function submitQuiz(Request $request)
	{
		$this->validate($request, [
			'classroom_id' => 'required|exists:classrooms,id',
			'quiz_id' => 'required|exists:quizzes,id',
			'answers' => 'required'
		], [
			'required' => 'Kolom :attribute diperlukan!',
			'exists' => 'Kolom :attribute tidak ditemukan!'
		]);

		$quiz = Quiz::findOrFail($request->quiz_id);

		$total      = $quiz->multiplechoices->count();
		$realAnswer = $quiz->multiplechoices->pluck('correct_answer', 'id')->toArray();
		$userAnswer = $request->answers;

		ksort($realAnswer);
		ksort($userAnswer);

		$unanswered = count(array_diff_key($realAnswer, $userAnswer));
		$correct    = count(array_intersect_assoc($realAnswer, $userAnswer));
		$wrong      = count(array_diff_assoc($realAnswer, $userAnswer));

		$data = [
			'answer' => json_encode($request->answers),
			'unanswered' => $unanswered,
			'correct' => $correct,
			'wrong' => $total - $correct,
			'score' => $correct / $total * 100
		];

		if($request->status) {
			$data['status'] = 'done';
		}

		$quiz->students()
			->sync([Auth::user()->id =>  $data], false);

		return response()->json([
			'redirect' => route('classrooms.quizzes', $request->classroom_id),
			'unanswered' => $unanswered
		]);
	}
}
