<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionPostPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('competition_post_points', function (Blueprint $table) {
            
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('talent_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->integer('competition_post_id')->unsigned()->nullable();
            $table->integer('voter_id')->unsigned()->nullable();
            
            $table->integer('points')->default(0);
            $table->boolean('is_voted')->default(1);
            
            $table->foreign('talent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('voter_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('competition_post_id')->references('id')->on('competitions_posts')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('competitions_posts_votes');
    }
}
