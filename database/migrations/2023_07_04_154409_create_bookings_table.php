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
            $table->foreignId('vehicle_id')->constrained();
            $table->foreignId('driver_id')->constrained();
            $table->foreignId('peminjam_id')->constrained()->references('id')->on('users');
            $table->foreignId('approver_id')->constrained()->references('id')->on('users');
            $table->boolean('is_approved')->default(0);
            $table->boolean('need_approval')->default(1);
            $table->timestamp('start_book')->nullable();
            $table->timestamp('end_book')->nullable();
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