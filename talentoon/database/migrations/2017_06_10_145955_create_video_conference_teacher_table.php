<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoConferenceTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('video_conference_teacher', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('wiziq_teacher_name')->nullable();
            $table->string('wiziq_teacher_email')->nullable();
            $table->string('wiziq_teacher_password')->default("123456")->nullable();
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
        Schema::dropIfExists('video_conference_teacher');
    }
}
