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
        Schema::create('effectiveness_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('courseuser_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id')->nullable();
            $table->timestamps();

            $table->foreign('courseuser_id')->references('id')->on('course_users');
            $table->foreign('user_id')->references('manager_user_id')->on('course_users')->onUpdate('cascade');
            $table->foreign('question_id')->references('id')->on('effectiveness_questions');
            $table->foreign('answer_id')->references('id')->on('effectiveness_question_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effectiveness_users');
    }
};
