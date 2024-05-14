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
        Schema::create('effectiveness_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('effectivenessquestion_id');
            $table->string('answer');
            $table->timestamps();

            $table->foreign('effectivenessquestion_id')->references('id')->on('effectiveness_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effectiveness_question_answers');
    }
};
