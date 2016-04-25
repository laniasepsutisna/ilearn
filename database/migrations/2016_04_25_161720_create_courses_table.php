<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function (Blueprint $table) {
			$table->uuid('id')->unique();
			$table->uuid('teacher_id');
			$table->string('name', 60);
			$table->string('description', 500);
			$table->string('picture');
			$table->enum('level', ['mudah', 'normal', 'sulit']);
			$table->timestamps();

			$table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

			$table->primary(['id']);
		});
		
		Schema::create('classroom_course', function (Blueprint $table) {
			$table->uuid('classroom_id');
			$table->uuid('course_id');
			$table->timestamps();

			$table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');

			$table->primary(['classroom_id', 'course_id']);
		});

		Schema::create('modules', function (Blueprint $table) {
			$table->uuid('id')->unique();
			$table->uuid('course_id');
			$table->string('name', 60);
			$table->string('description', 500);
			$table->string('media', 250);
			$table->timestamps();

			$table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
			
			$table->primary(['id']);
		});

		Schema::create('module_user', function (Blueprint $table) {
			$table->uuid('module_id');
			$table->uuid('user_id');
			$table->timestamps();

			$table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

			$table->primary(['module_id', 'user_id']);
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('module_user');
		Schema::drop('modules');
		Schema::drop('classroom_course');
		Schema::drop('courses');
	}
}
