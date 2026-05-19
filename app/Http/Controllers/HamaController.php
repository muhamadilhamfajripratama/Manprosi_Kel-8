<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanHama;

class HamaController extends Controller
{
    public function index()
    {
        $batches = BatchTanam::with('lahan')->where('status', 'aktif')->get(); 
        $riwayats = KegiatanHama::orderBy('tanggal', 'desc')->get();

        $totalTindakan = $riwayats->count();
        $totalBiaya = $riwayats->sum(function ($item) {
            return $item->total_biaya; // Mengambil dari accessor model
        });

        return view('hama', compact('batches', 'riwayats', 'totalTindakan', 'totalBiaya'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'            => 'required',
            'tanggal'             => 'required|date',
            'jenis_hama'          => 'required|string',
            'tingkat_keparahan'   => 'required|in:Ringan,Sedang,Berat', // Validasi Enum
            'metode_pengendalian' => 'required|string',
            'bahan_pengendalian'  => 'required|string',
            'dosis'               => 'required|numeric',
            'satuan'              => 'required|string',
            'harga_beli'          => 'required|numeric',
        ]);

        KegiatanHama::create([
            'batch_id'            => $request->batch_id,
            'tanggal'             => $request->tanggal,
            'jenis_hama'          => $request->jenis_hama,
            'tingkat_keparahan'   => $request->tingkat_keparahan,
            'metode_pengendalian' => $request->metode_pengendalian,
            'bahan_pengendalian'  => $request->bahan_pengendalian,
            'dosis'               => $request->dosis,
            'satuan'              => $request->satuan,
            'harga_beli'          => $request->harga_beli,
            'catatan'             => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pengendalian hama berhasil dicatat!');
    }
}