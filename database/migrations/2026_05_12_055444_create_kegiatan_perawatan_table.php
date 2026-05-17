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
        Schema::create('kegiatan_perawatan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batch_tanam')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('jenis', ['Penyiangan', 'Pemangkasan', 'Penopang', 'Penyulaman', 'Pembersihan Lahan', 'Lainnya']);
            $table->text('deskripsi')->nullable();
            $table->decimal('jumlah_jam', 5, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('biaya', 15, 2)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->index(['batch_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan_perawatan');
    }
};
