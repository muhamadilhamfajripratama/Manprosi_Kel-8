<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanPerawatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_perawatan';

    protected $fillable = [
        'batch_id',
        'tanggal',
        'jenis',
        'deskripsi',
        'jumlah_jam',
        'price',
        'biaya',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah_jam' => 'decimal:2',
            'price' => 'decimal:2',
            'biaya' => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->jumlah_jam && $model->price) {
                $model->biaya = $model->jumlah_jam * $model->price;
            }
        });
    }

    public function batchTanam()
    {
        return $this->belongsTo(BatchTanam::class, 'batch_id');
    }
}
