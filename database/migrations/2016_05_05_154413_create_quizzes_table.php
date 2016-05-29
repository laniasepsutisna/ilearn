<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizzesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('quizzes', function(Blueprint $table){
			$table->uuid('id')->unique();
			$table->string('teacher_id');
			$table->string('title');
			$table->string('type');
			$table->integer('time_limit');
			$table->timestamps();

			$table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

			$table->primary(['id']);
		});

		/* Multiple Choice */
		Schema::create('mc_questions', function(Blueprint $table){
			$table->uuid('id')->unique();
			$table->string('quiz_id');
			$table->string('question');
			$table->string('image', 150);
			$table->timestamps();
			
			$table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

			$table->primary(['id']);
		});

		Schema::create('mc_answers', function(Blueprint $table){
			$table->uuid('id')->unique();
			$table->string('question_id');
			$table->string('answer_1');
			$table->string('answer_2');
			$table->string('answer_3');
			$table->string('answer_4');
			
			$table->foreign('question_id')->references('id')->on('mc_questions')->onDelete('cascade');

			$table->primary(['id']);
		});

		/* Essay */
		Schema::create('essay_questions', function(Blueprint $table){
			$table->uuid('id')->unique();
			$table->string('quiz_id');
			$table->string('question');
			$table->string('media');
			$table->string('image');
			
			$table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

			$table->primary(['id']);
		});

		Schema::create('essay_answers', function(Blueprint $table){
			$table->uuid('id')->unique();
			$table->string('question_id');
			$table->string('answer');
			$table->boolean('is_correct');
			
			$table->foreign('question_id')->references('id')->on('mc_questions')->onDelete('cascade');

			$table->primary(['id']);
		});

		Schema::create('classroom_quiz', function(Blueprint $table){
			$table->uuid('classroom_id');
			$table->uuid('quiz_id');

			$table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
			$table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

			$table->primary(['classroom_id', 'quiz_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('mc_answers');
		Schema::drop('essay_answers');
		Schema::drop('essay_questions');
		Schema::drop('mc_questions');
		Schema::drop('classroom_quiz');
		Schema::drop('quizzes');
	}
}
