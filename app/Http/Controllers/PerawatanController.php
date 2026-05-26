<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanPerawatan;

class PerawatanController extends Controller
{
    public function index()
    {
        $batches = BatchTanam::with('lahan')->where('status', 'aktif')->get(); 
        $riwayats = KegiatanPerawatan::orderBy('tanggal', 'desc')->get();

        // Hitung total jam kerja dan total biaya dari kolom 'biaya'
        $totalJam = $riwayats->sum('jumlah_jam');
        $totalBiaya = $riwayats->sum('biaya');

        return view('perawatan', compact('batches', 'riwayats', 'totalJam', 'totalBiaya'));
    }

    public function store(Request $request)
    {
        // Validasi sesuai dengan Enum di migration
        $request->validate([
            'batch_id'   => 'required',
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:Penyiangan,Pemangkasan,Penopang,Penyulaman,Pembersihan Lahan,Lainnya',
            'jumlah_jam' => 'nullable|numeric',
            'price'      => 'nullable|numeric',
            'biaya'      => 'nullable|numeric',
        ]);

        KegiatanPerawatan::create([
            'batch_id'   => $request->batch_id,
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'deskripsi'  => $request->deskripsi,
            'jumlah_jam' => $request->jumlah_jam,
            'price'      => $request->price,
            'biaya'      => $request->biaya, // Disimpan langsung ke database
            'catatan'    => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data perawatan berhasil dicatat!');
    }
}