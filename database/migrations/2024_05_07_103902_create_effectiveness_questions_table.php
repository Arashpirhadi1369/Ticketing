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
        Schema::create('effectiveness_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('effectiveness_id');
            $table->string('question');
            $table->timestamps();

            $table->foreign('effectiveness_id')->references('id')->on('effectivenesses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('effectiveness_questions');
    }
};
