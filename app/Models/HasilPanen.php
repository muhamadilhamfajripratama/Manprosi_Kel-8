<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'hasil_panen';

    protected $fillable = [
        'batch_id',
        'tanggal_panen',
        'jumlah_kg',
        'komoditas',
        'kualitas',
        'umur_panen_hari',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_panen' => 'date',
            'jumlah_kg' => 'decimal:2',
        ];
    }

    public function batchTanam()
    {
        return $this->belongsTo(BatchTanam::class, 'batch_id');
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'hasil_panen_id');
    }

    public function getSisaStokAttribute()
    {
        $terjual = $this->penjualan->sum('jumlah_kg');
        return $this->jumlah_kg - $terjual;
    }
}
