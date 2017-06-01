<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('posts_competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();


            $table->string('post_competition_title');
            $table->string('post_competition_description');
            $table->string('post_competition_media_type');
            $table->string('post_competition_media_url');

            $table->integer('talent_id')->unsigned();
            $table->integer('competition_id')->unsigned();


            $table->foreign('talent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');

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
        Schema::dropIfExists('posts_competitions');
    }
}
