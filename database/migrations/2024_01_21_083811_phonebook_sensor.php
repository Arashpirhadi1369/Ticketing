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
        Schema::create('phonebook_sensor', function (Blueprint $table) {
            $table->unsignedBigInteger('sensor_id');
            $table->unsignedBigInteger('phonebook_id');

            $table->foreign('sensor_id')->references('id')->on('sensors');

            $table->foreign('phonebook_id')->references('id')->on('phonebooks');

            $table->primary(['sensor_id', 'phonebook_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phonebook_sensor');
    }
};
