<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->string('username', 15)->unique();
            $table->string('firstname', 30);
            $table->string('lastname', 30);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->enum('role', ['staff', 'teacher', 'student']);
            $table->enum('status', ['active', 'banned', ]);
            $table->boolean('login', [0, 1]);
            $table->rememberToken();
            $table->timestamps();

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}