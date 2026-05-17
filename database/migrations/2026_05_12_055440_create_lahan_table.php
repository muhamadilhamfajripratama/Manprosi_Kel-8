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
        Schema::create('lahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('petani_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lahan');
            $table->decimal('luas_ha', 10, 2);
            $table->enum('jenis_tanah', ['Alluvial', 'Latosol', 'Regosol', 'Grumosol', 'Andosol']);
            $table->enum('status_kepemilikan', ['Milik Sendiri', 'Sewa', 'Gadai', 'Bagi Hasil']);
            $table->json('titik_batas');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->index('petani_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan');
    }
};
