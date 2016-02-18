<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserMeta extends Migration
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
            $table->integer('user_id')->unsigned();
            $table->string('picture');
            $table->string('cover');
            $table->string('date_ofbirth');
            $table->string('month_ofbirth');
            $table->string('year_ofbirth');
            $table->string('address');
            $table->string('telp_no');
            $table->string('parent_telp_no');
            $table->string('facebook_url');
            $table->string('twitter_url');

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
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
