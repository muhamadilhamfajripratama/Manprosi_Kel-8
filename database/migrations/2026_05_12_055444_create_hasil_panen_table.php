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
        Schema::create('hasil_panen', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batch_tanam')->onDelete('cascade');
            $table->date('tanggal_panen');
            $table->decimal('jumlah_kg', 10, 2);
            $table->string('komoditas', 100);
            $table->enum('kualitas', ['Grade A', 'Grade B', 'Grade C']);
            $table->integer('umur_panen_hari')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            
            $table->index(['batch_id', 'tanggal_panen']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_panen');
    }
};
