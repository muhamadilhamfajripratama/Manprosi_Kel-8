<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lahan extends Model
{
    use HasFactory;

    protected $table = 'lahan';

    protected $fillable = [
        'petani_id',
        'nama_lahan',
        'luas_ha',
        'jenis_tanah',
        'status_kepemilikan',
        'titik_batas',
        'latitude',
        'longitude',
        'catatan',
    ];

    protected $casts = [
        'titik_batas' => 'array',  // otomatis encode/decode JSON
        'luas_ha'     => 'float',
        'latitude'    => 'float',
        'longitude'   => 'float',
    ];

    // Relasi ke User (petani)
    public function petani()
    {
        return $this->belongsTo(User::class, 'petani_id');
    }
}