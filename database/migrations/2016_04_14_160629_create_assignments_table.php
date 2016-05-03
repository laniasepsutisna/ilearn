<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignments', function (Blueprint $table) {
			$table->uuid('id')->unique();
			$table->uuid('teacher_id');
			$table->string('title', 60);
			$table->string('file');
			$table->text('content', 500);
			$table->timestamps();

			$table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

			$table->primary(['id']);
		});

		Schema::create('assignment_classroom', function (Blueprint $table) {
			$table->uuid('assignment_id');
			$table->uuid('classroom_id');
			$table->date('deadline');
			$table->timestamps();

			$table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');
			$table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');

			$table->primary(['assignment_id', 'classroom_id']);
		});
		
		Schema::create('submissions', function (Blueprint $table) {
			$table->uuid('assignment_id');
			$table->uuid('user_id');
			$table->string('title', 150);
			$table->string('file')->nullable();
			$table->string('content', 500);
			$table->integer('chance');
			$table->timestamps();

			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('assignment_id')->references('id')->on('assignments')->onDelete('cascade');

			$table->primary(['assignment_id', 'user_id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assignment_classroom');
		Schema::drop('submissions');
		Schema::drop('assignments');
	}
}
