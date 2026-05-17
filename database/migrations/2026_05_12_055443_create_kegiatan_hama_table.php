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
        Schema::create('kegiatan_hama', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batch_tanam')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('jenis_hama', 100);
            $table->enum('tingkat_keparahan', ['Ringan', 'Sedang', 'Berat']);
            $table->string('metode_pengendalian', 100);
            $table->string('bahan_pengendalian');
            $table->decimal('dosis', 10, 2);
            $table->string('satuan', 50);
            $table->decimal('harga_beli', 15, 2);
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
        Schema::dropIfExists('kegiatan_hama');
    }
};
