<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('target_petani'); // Berisi 'all', 'Fajri', 'Reyhan', 'Faiza', atau 'Alya'
            $table->string('komoditas')->default('Bawang Putih Bonggol'); 
            $table->decimal('kuantitas', 8, 2); // Angka desimal untuk Ton
            $table->string('status')->default('menunggu'); // menunggu, diterima, ditolak
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaans');
    }
};
