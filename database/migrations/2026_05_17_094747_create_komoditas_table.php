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
        Schema::create('komoditas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('durasi_standar_hari');
            $table->string('satuan_hasil'); // Contoh: 'kg', 'ton', 'kuintal'
            $table->text('deskripsi')->nullable();
            
            // Ini akan otomatis membuat kolom created_at dan updated_at
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditas');
    }
};
