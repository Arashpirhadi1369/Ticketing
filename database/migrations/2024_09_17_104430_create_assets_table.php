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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('asset_tag')->nullable();
            $table->string('asset_name');
            $table->unsignedBigInteger('asset_unit_id');
            $table->unsignedBigInteger('belong_to_user')->nullable();
            $table->string('asset_location')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('picture')->nullable();
            $table->string('qrcode')->nullable();
            $table->timestamps();

            $table->foreign('asset_unit_id')->references('id')->on('units');

            $table->foreign('belong_to_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
};
