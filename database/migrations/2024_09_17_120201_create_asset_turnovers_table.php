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
        Schema::create('asset_turnovers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('asset_id');
            $table->string('unit');
            $table->string('belong_to_user')->nullable();
            $table->string('asset_location')->nullable();
            $table->string('delivery_date')->nullable();
            $table->boolean('conflict')->default(0);
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('assets');

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asset_turnovers');
    }
};
