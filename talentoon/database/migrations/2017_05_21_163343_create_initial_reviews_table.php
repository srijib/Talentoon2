<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('initial_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            //references the table category talents to reference the id where the talent is mawhoob at certain category
            $table->integer('category_talent_id')->unsigned();
            $table->foreign('category_talent_id')->references('id')->on('category_talents')->onDelete('cascade');

            $table->integer('category_mentor_id')->unsigned();
            $table->foreign('category_mentor_id')->references('id')->on('category_mentors')->onDelete('cascade');


            $table->integer('review_media_id')->unsigned();
            $table->foreign('review_media_id')->references('id')->on('review_media')->onDelete('cascade');


            $table->integer('level_single');
            $table->string('comment');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('initial_reviews');
    }
}
