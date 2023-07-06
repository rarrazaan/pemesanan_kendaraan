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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->enum('jenis_angkut', ['Angkut Barang', 'Angkut Orang']);
            $table->enum('pemilik', ['Milik Perusahaan', 'Sewa']);
            $table->integer('konsumsi_BBM');
            $table->timestamp('jadwal_service')->nullable();
            $table->string('riwayat_pemakaian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};