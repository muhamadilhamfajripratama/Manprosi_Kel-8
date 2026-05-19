<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanIrigasi;

class IrigasiController extends Controller
{
    public function index()
    {
        $batches = BatchTanam::with('lahan')->where('status', 'aktif')->get(); 
        $riwayats = KegiatanIrigasi::orderBy('tanggal', 'desc')->get();

        // Statistik
        $totalDebit = $riwayats->sum('debit_liter');
        $totalIrigasi = $riwayats->count(); // Ganti jadi hitung jumlah aktivitas

        return view('irigasi', compact('batches', 'riwayats', 'totalDebit', 'totalIrigasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'         => 'required',
            'tanggal'          => 'required|date',
            'debit_liter'      => 'required|numeric',
            'sumber_pengairan' => 'nullable|string', // Sesuai migration: nullable
        ]);

        KegiatanIrigasi::create([
            'batch_id'         => $request->batch_id,
            'tanggal'          => $request->tanggal,
            'debit_liter'      => $request->debit_liter,
            'sumber_pengairan' => $request->sumber_pengairan,
            'catatan'          => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data irigasi berhasil dicatat!');
    }
}