<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('review_media', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('category_talent_id')->unsigned();
            $table->foreign('category_talent_id')->references('id')->on('category_talents')->onDelete('cascade');


            $table->string('review_media_type');
            $table->string('review_media_url');

            $table->timestamps();
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
        Schema::dropIfExists('review_media');
    }
}
