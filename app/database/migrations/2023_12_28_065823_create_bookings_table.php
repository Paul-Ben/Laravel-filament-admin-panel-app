<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('bookingId')->unique('bkg' + rand(0001,100000));
            $table->foreignId('hotelId')->constrained()->cascadeOnDelete();
            $table->foreignId('roomId')->constrained()->cascadeOnDelete();
            $table->foreignId('guestId')->constrained()->cascadeOnDelete();
            $table->date('checkinDate');
            $table->date('checkoutDate');
            $table->integer('no_of_guests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
