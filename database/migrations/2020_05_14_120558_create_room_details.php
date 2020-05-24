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
            $table->string('capacity');
            $table->integer('cost');
            $table->boolean('freeWifi')->default(false);
            $table->boolean('noSmoking')->default(false);
            $table->string('shower')->nullable();
            $table->string('scenery')->nullable();
            $table->string('entertainment')->nullable();
            $table->string('convenience')->nullable();
            $table->string('furniture')->nullable();
            $table->string('service')->nullable();
            $table->string('security_safety')->nullable();
            $table->string('laundry')->nullable();
            $table->string('food')->nullable();
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
