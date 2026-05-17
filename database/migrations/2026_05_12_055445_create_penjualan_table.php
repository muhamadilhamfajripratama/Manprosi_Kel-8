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
        Schema::create('penjualan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_panen_id')->constrained('hasil_panen')->onDelete('cascade');
            $table->foreignId('distributor_id')->nullable()->constrained('users');
            $table->string('nama_pembeli')->nullable();
            $table->date('tanggal');
            $table->decimal('jumlah_kg', 10, 2);
            $table->decimal('harga_per_kg', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->index('tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');
    }
};
