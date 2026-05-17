<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanIrigasi extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_irigasi';

    protected $fillable = [
        'batch_id',
        'tanggal',
        'debit_liter',
        'sumber_pengairan',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'debit_liter' => 'decimal:2',
        ];
    }

    public function batchTanam()
    {
        return $this->belongsTo(BatchTanam::class, 'batch_id');
    }
}
