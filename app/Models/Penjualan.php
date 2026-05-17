<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'hasil_panen_id',
        'distributor_id',
        'nama_pembeli',
        'tanggal',
        'jumlah_kg',
        'harga_per_kg',
        'total_harga',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah_kg' => 'decimal:2',
            'harga_per_kg' => 'decimal:2',
            'total_harga' => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->jumlah_kg && $model->harga_per_kg) {
                $model->total_harga = $model->jumlah_kg * $model->harga_per_kg;
            }
        });
    }

    public function hasilPanen()
    {
        return $this->belongsTo(HasilPanen::class, 'hasil_panen_id');
    }

    public function distributor()
    {
        return $this->belongsTo(User::class, 'distributor_id');
    }
}
