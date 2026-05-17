<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi';

    protected $fillable = [
        'user_id',
        'batch_id',
        'tipe',
        'judul',
        'pesan',
        'tanggal_estimasi',
        'sudah_dibaca',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_estimasi' => 'date',
            'sudah_dibaca' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function batchTanam()
    {
        return $this->belongsTo(BatchTanam::class, 'batch_id');
    }
}
