<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalCompetitionPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('final_competition_points', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            
            $table->integer('talent_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->integer('competition_post_id')->unsigned();
            
            $table->integer('audienceSumOfPoints')->default(0);
            $table->integer('mentorsSumOfPoints')->default(0);
            $table->integer('audienceAverageOfPoints')->default(0);
            $table->integer('mentorsAverageOfPoints')->default(0);
            $table->integer('total')->default(0);

            $table->foreign('talent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
    }
}
