<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KegiatanPerawatan extends Model
{
    protected $table = 'kegiatan_perawatan';

    // Sesuaikan dengan nama kolom di migration milikmu
    protected $fillable = [
        'batch_id',
        'tanggal',
        'jenis',
        'deskripsi',
        'jumlah_jam',
        'price',
        'biaya',
        'catatan'
    ];

    public function batchTanam()
    {
        return $this->belongsTo(BatchTanam::class, 'batch_id');
    }
}