<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class QuizController extends Controller
{
	public function index()
	{
		$page_title = 'Perpustakaan - Quiz';

		return view('user.quizes.index', compact('page_title'));
	}

	public function create()
	{
		$page_title = 'Quiz Baru';

		return view('user.quizes.create', compact('page_title'));
	}
}
