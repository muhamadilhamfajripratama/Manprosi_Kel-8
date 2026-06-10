<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    use HasFactory;

    // Gunakan $fillable demi keamanan data transaksi
    protected $fillable = [
        'target_petani',
        'komoditas',
        'kuantitas',
        'harga',
        'status',
    ];
}