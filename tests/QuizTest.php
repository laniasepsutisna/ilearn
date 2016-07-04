<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class QuizTest extends TestCase
{
  public function testAddQuiz()
  {
  	$user = User::where('username', 'timoti')->first();

    $this->actingAs($user)
      ->visit('/quizzes/create')
    	->type('Quiz Baru', 'title')
    	->select(50, 'pass_score')
    	->select(60, 'time_limit')
    	->press('quizSubmit');
  }
}
