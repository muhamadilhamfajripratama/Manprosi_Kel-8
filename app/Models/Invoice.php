<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    
    // Memberitahu Laravel bahwa Primary Key-nya bukan 'id', melainkan 'id_invoice'
    protected $primaryKey = 'id_invoice';

    protected $fillable = [
        'id_penjualan', 
        'nomor_invoice', 
        'tanggal_cetak', 
        'catatan'
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_penjualan');
    }
}