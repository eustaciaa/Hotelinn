<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel')->onDelete('cascade');
            $table->string('name')->unique();
            $table->integer('available');
            $table->integer('capacity');
            $table->integer('cost');
            $table->string('photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_details');
    }
}
