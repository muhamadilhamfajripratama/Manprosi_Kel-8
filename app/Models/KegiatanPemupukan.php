<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPemupukan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_pemupukan';

    protected $fillable = [
        'batch_id',
        'tanggal',
        'jenis_pupuk',
        'dosis',
        'satuan',
        'harga_beli',
        'nomide',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'dosis' => 'decimal:2',
            'harga_beli' => 'decimal:2',
        ];
    }

    public function batchTanam()
    {
        return $this->belongsTo(BatchTanam::class, 'batch_id');
    }

    public function getTotalBiayaAttribute()
    {
        return $this->dosis * $this->harga_beli;
    }
}
