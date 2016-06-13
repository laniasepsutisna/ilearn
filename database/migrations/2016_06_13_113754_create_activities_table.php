<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('activities', function (Blueprint $table) {
      $table->uuid('id')->unique();
      $table->uuid('teacher_id');
      $table->uuid('classroom_id');
      $table->string('action');
      $table->enum('route', ['classrooms.assignmentdetail', 'classrooms.coursedetail', 'classrooms.quizdetail']);
      $table->uuid('detail');
      $table->timestamps();

      $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('activities');
  }
}
