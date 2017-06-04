<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMentorReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('mentor_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('mentor_id')->unsigned();
            $table->integer('post_id')->unsigned();
            $table->integer('points');
            $table->string('comment');

            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('mentor_reviews');
    }
}
