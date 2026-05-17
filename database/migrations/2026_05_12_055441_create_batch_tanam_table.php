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
        Schema::create('batch_tanam', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lahan_id')->constrained('lahan')->onDelete('cascade');
            $table->foreignId('petani_id')->constrained('users');
            $table->string('komoditas', 100);
            $table->date('tanggal_tanam');
            $table->string('asal_bibit');
            $table->decimal('jumlah_bibit', 10, 2);
            $table->string('satuan_bibit', 50);
            $table->string('jarak_tanam_cm', 50);
            $table->enum('metode_tanam', ['Bibit', 'Semai', 'Pindah Tanam']);
            $table->integer('durasi_standar_hari');
            $table->enum('status', ['aktif', 'selesai', 'gagal'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->index(['petani_id', 'tanggal_tanam']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_tanam');
    }
};
