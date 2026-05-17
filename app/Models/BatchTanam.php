<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BatchTanam extends Model
{
    protected $table = 'batch_tanam'; 

    protected $fillable = [
        'lahan_id', 
        'petani_id', 
        'komoditas', 
        'tanggal_tanam', 
        'asal_bibit', 
        'jumlah_bibit', 
        'satuan_bibit', 
        'jarak_tanam_cm', 
        'metode_tanam', 
        'durasi_standar_hari', 
        'status', 
        'catatan'
    ];

    public function lahan()
    {
        return $this->belongsTo(Lahan::class, 'lahan_id');
    }

    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id');
    }
}