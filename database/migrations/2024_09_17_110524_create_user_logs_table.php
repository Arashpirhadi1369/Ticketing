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
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->ipAddress('ip')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('action_id');
            $table->unsignedBigInteger('record_id');
            $table->string('attribute')->nullable();
            $table->string('old')->nullable();
            $table->string('new')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('table_id')->references('id')->on('table_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_logs');
    }
};
