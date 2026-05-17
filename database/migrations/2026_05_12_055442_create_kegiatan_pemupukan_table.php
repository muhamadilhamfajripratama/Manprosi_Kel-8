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
        Schema::create('kegiatan_pemupukan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batch_tanam')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('jenis_pupuk', 100);
            $table->decimal('dosis', 10, 2);
            $table->string('satuan', 50);
            $table->decimal('harga_beli', 15, 2);
            $table->string('nomide', 100)->nullable();
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
        Schema::dropIfExists('kegiatan_pemupukan');
    }
};
