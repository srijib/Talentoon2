<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsPostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::create('competitions_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('talent_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->string('competition_post_title');
            $table->string('competition_post_description');
            $table->string('competition_post_media_type');
            $table->string('competition_post_media_url');
            $table->foreign('talent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
        Schema::dropIfExists('competitions_posts');
    }

}
