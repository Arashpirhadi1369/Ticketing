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
        Schema::create('sms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_user_id');
            $table->string('source_number');
            $table->unsignedBigInteger('receiver_user_id')->nullable();
            $table->string('destination_number');
            $table->string('subject')->nullable();
            $table->string('receiver_name')->nullable();
            $table->string('message');
            $table->unsignedBigInteger('status');
            $table->unsignedBigInteger('cost');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('sender_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('receiver_user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms');
    }
};
