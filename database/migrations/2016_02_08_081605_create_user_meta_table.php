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
        Schema::create('user_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('picture');
            $table->string('cover');
            $table->string('dayofbirth');
            $table->string('monthofbirth');
            $table->string('yearofbirth');
            $table->string('address');
            $table->string('telp_no');
            $table->string('parent_telp_no');
            $table->string('social_url');

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
        Schema::drop('user_meta');
    }
}
