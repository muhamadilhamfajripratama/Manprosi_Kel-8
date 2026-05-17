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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('batch_id')->nullable()->constrained('batch_tanam')->onDelete('set null');
            $table->enum('tipe', ['panen', 'prediksi_stok', 'perawatan', 'sistem']);
            $table->string('judul');
            $table->text('pesan');
            $table->date('tanggal_estimasi')->nullable();
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
            
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
