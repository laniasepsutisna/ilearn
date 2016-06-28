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
      $table->integer('pass_score');
      $table->integer('time_limit');
      $table->timestamps();

      $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

      $table->primary(['id']);
    });

    Schema::create('mc_questions', function(Blueprint $table){
      $table->uuid('id')->unique();
      $table->string('quiz_id');
      $table->string('question', 300);
      $table->string('image', 150);
      $table->timestamps();
      
      $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

      $table->primary(['id']);
    });

    Schema::create('mc_answers', function(Blueprint $table){
      $table->uuid('id')->unique();
      $table->string('question_id');
      $table->string('answer_1', 60);
      $table->string('answer_2', 60);
      $table->string('answer_3', 60);
      $table->string('answer_4', 60);
      $table->string('correct_answer');
      
      $table->foreign('question_id')->references('id')->on('mc_questions')->onDelete('cascade');

      $table->primary(['id']);
    });

    Schema::create('classroom_quiz', function(Blueprint $table){
      $table->uuid('classroom_id');
      $table->uuid('quiz_id');
      $table->timestamps();

      $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
      $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');

      $table->primary(['classroom_id', 'quiz_id']);
    });

    Schema::create('quiz_user', function(Blueprint $table){
      $table->uuid('quiz_id');
      $table->uuid('student_id');
      $table->timestamp('time');
      $table->text('answer');
      $table->enum('status', ['ongoing', 'done']);
      $table->integer('unanswered');
      $table->integer('correct');
      $table->integer('wrong');
      $table->integer('score');

      $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
      $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

      $table->primary(['quiz_id', 'student_id']);
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('quiz_user');
    Schema::drop('mc_answers');
    Schema::drop('mc_questions');
    Schema::drop('classroom_quiz');
    Schema::drop('quizzes');
  }
}
