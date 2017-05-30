<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->time('time_from');
            $table->time('time_to');
            $table->date('date_from');
            $table->date('date_to');
            $table->string('location');
            $table->string('title');
            $table->string('description');
            $table->boolean('is_approved');
            $table->boolean('is_paid');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('mentor_id')->unsigned()->nullable();
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
        Schema::dropIfExists('events');
    }
}
