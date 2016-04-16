<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMetaTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_metas', function (Blueprint $table) {
			$table->uuid('id')->unique();
			$table->uuid('user_id')->unique();
			$table->uuid('major_id')->nullable();
			$table->string('nis', 60)->unique()->nullable();
			$table->string('nisn', 60)->unique()->nullable();
			$table->string('agama', 15);
			$table->string('tempatlahir', 15);
			$table->date('tanggallahir', 15);
			$table->string('telp', 13);
			$table->text('alamat', 150);
			$table->string('orangtua', 60);
			$table->string('wali', 60);
			$table->string('telp_orangtua', 13);
			$table->string('picture', 150);
			$table->string('cover', 150);
			$table->timestamps();

			$table->primary(['id']);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_metas');
	}
}
