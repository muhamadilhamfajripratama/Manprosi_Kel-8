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
        Schema::create('kegiatan_irigasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batch_tanam')->onDelete('cascade');
            $table->date('tanggal');
            $table->decimal('debit_liter', 10, 2);
            $table->string('sumber_pengairan', 100)->nullable();
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
        Schema::dropIfExists('kegiatan_irigasi');
    }
};
