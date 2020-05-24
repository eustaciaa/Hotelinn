<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotel');
            $table->foreignId('room_id')->constrained('room_details');
            $table->integer('roomTotal');
            $table->date('bookdate');
            $table->date('checkIn')->nullable($value = true);
            $table->date('checkOut')->nullable($value = true);
            $table->boolean('finished')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('history');
    }
}
