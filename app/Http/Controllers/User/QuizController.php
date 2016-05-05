<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
	public function index()
	{
		$quizzes = []; //Quiz::where('teacher_id', Auth::user()->id)->paginate(7);
		$page_title = 'Perpustakaan - Quiz';

		return view('user.quizzes.index', compact('page_title', 'quizzes'));
	}

	public function create()
	{
		$page_title = 'Quiz Baru';

		return view('user.quizzes.create', compact('page_title'));
	}
}
