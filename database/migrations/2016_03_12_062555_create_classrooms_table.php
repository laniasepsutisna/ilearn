<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('subject_id');
            $table->uuid('major_id');
            $table->uuid('teacher_id');
            $table->string('grade', 5);
            $table->string('description', 150);
            $table->string('color', 7);
            $table->string('picture', 150);
            $table->timestamps();

            $table->primary(['id']);

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('classroom_user', function (Blueprint $table) {
            $table->uuid('classroom_id');
            $table->uuid('user_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['classroom_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('classroom_user');
        Schema::drop('classrooms');
    }
}
