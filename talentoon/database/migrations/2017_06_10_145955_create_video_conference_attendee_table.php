<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoConferenceAttendeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('video_conference_attendee', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('class_id')->nullable();
            $table->string('wiziq_attendee_id')->nullable();
            $table->string('wiziq_attendee_url')->nullable();
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
        Schema::dropIfExists('video_conference_attendee');
    }
}
