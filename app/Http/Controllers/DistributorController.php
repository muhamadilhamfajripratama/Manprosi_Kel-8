<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;

class DistributorController extends Controller
{
    public function kirimPermintaan(Request $request)
    {
        // Menyimpan data langsung ke database
        Permintaan::create([
            'target_petani' => $request->petani,
            'komoditas' => $request->komoditas,
            'kuantitas' => $request->kuantitas,
            'status' => 'menunggu'
        ]);

        // Mengirim respons sukses ke AJAX
        return response()->json([
            'status' => 'success',
            'message' => 'Permintaan berhasil direkam di database.'
        ]);
    }
}