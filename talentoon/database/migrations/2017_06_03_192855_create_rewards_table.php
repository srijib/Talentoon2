<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRewardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        //
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('first_place_competition_reward')->nullable();
            $table->string('second_place_competition_reward')->nullable();
            $table->string('third_place_competition_reward')->nullable();

            $table->string('first')->nullable();
            $table->string('second')->nullable();
            $table->string('third')->nullable();
            $table->string('fourth')->nullable();
            $table->string('fifth')->nullable();
            $table->string('sixth')->nullable();
            $table->string('seventh')->nullable();
            $table->string('eighths')->nullable();
            $table->string('ninth')->nullable();
            $table->string('tenth')->nullable();


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
        Schema::dropIfExists('rewards');
    }
}
