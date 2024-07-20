<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->unsignedBigInteger('manager_user_id');
            $table->string('survey_finished_date')->nullable();
            $table->string('effectiveness_finished_date')->nullable();
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses');

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('unit_id')->references('id')->on('units');

            $table->foreign('manager_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_users');
    }
};
