<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionJoinTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('competition_join', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('talent_id')->unsigned();
            $table->integer('competition_id')->unsigned();
            $table->boolean('joined')->default(0);
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
    }

}
