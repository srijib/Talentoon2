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
            $table->string('description');
            $table->string('points_description')->default('First Winner recieves 100 XPs,Second Winner recieves 75 XPs,Third Winner recieves 50 XPs');
            $table->integer('competition_from_level');
            $table->integer('competition_to_level');
            $table->date('competition_start_date');
            $table->date('competition_end_date');
            $table->time('competition_start_time');
            $table->time('competition_end_time');           
            $table->integer('first_winner_talent_id')->unsigned()->nullable();
            $table->integer('second_winner_talent_id')->unsigned()->nullable();
            $table->integer('third_winner_talent_id')->unsigned()->nullable();

            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('first_winner_talent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('second_winner_talent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('third_winner_talent_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

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
