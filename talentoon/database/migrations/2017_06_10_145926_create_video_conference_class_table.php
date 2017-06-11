<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoConferenceClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('video_conference_class', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('wiziq_class_id')->nullable();
            $table->string('wiziq_recording_url')->nullable();
            $table->string('wiziq_class_start_time')->nullable();
            $table->string('wiziq_class_duration')->nullable();
            $table->string('wiziq_class_attendee_limit')->nullable();
            $table->string('wiziq_presenter_url')->nullable();
            $table->string('wiziq_teacher_email')->nullable();
            $table->string('wiziq_teacher_id')->nullable();
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
        Schema::dropIfExists('video_conference_class');
    }
}
