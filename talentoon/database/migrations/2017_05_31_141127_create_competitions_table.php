<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('competitions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('mentor_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->integer('winner_talent_id')->unsigned();
            $table->integer('winner_points');

            $table->integer('competition_level');


            $table->date('competition_start_date');
            $table->time('competition_start_time');

            $table->date('competition_end_date');
            $table->time('competition_end_time');



            $table->date('voting_start_date');
            $table->time('voting_start_time');

            $table->date('voting_end_date');
            $table->time('voting_end_time');



            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('winner_talent_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitions');
        //
    }
}
