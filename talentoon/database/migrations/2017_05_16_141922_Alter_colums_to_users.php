<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterColumsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
        $table->string('date_of_birth')->nullable()->change();
        $table->string('gender')->nullable()->change();
        $table->string('login_token')->nullable()->change();
        $table->boolean('pending')->nullable()->change();
        $table->integer('type')->nullable()->change();
        $table->boolean('is_active')->nullable()->change();
        $table->integer('signup_type')->nullable()->change();
        $table->string('image')->nullable()->change();
        $table->string('phone')->nullable()->change();
        $table->integer('country_id')->unsigned()->nullable()->change();
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
    }
}
