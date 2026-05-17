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
Schema::create('invoice', function (Blueprint $table) {
            // Mengatur 'id_invoice' sebagai Primary Key auto-increment
            $table->id('id_invoice'); 
            
            // Foreign key ke tabel penjualan (pastikan tabel penjualan sudah ada)
            $table->unsignedBigInteger('id_penjualan'); 
            
            $table->string('nomor_invoice')->unique();
            $table->date('tanggal_cetak'); // Atau gunakan dateTime() jika butuh jam
            $table->text('catatan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
