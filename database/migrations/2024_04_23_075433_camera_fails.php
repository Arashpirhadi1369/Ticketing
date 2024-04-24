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
        Schema::create('camera_fails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('camera_id');
            $table->string('camera_name');
            $table->string('location');
            $table->ipAddress('ip');
            $table->string('jalalian_date');
            $table->timestamps();

            $table->foreign('camera_id')->references('id')->on('cameras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('camera_fails');
    }
};
