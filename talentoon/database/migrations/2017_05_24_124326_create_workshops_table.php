<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->time('time_from');
            $table->time('time_to');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('description');
            $table->boolean('is_approved');
            $table->integer('max_capacity');
            $table->integer('level');
            $table->string('media_url');
            $table->string('media_type');
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->integer('mentor_id')->unsigned();
            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('workshops');
    }
}
