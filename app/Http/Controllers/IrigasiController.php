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

    // FUNGSI UPDATE DATA IRIGASI
    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'   => 'required',
            'tanggal'    => 'required|date',
            'debit_liter'     => 'required|numeric',
            'sumber_pengairan' => 'required|string',
        ]);

        $irigasi = \App\Models\KegiatanIrigasi::findOrFail($id);
        
        $irigasi->update([
            'batch_id'   => $request->batch_id,
            'tanggal'    => $request->tanggal,
            'debit_liter'     => $request->debit_liter,
            'sumber_pengairan' => $request->sumber_pengairan,
            'catatan'    => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pengairan berhasil diperbarui!');
    }

    // FUNGSI HAPUS DATA IRIGASI
    public function destroy($id)
    {
        try {
            $irigasi = \App\Models\KegiatanIrigasi::findOrFail($id);
            $irigasi->delete();
            
            return redirect()->back()->with('success', 'Data pengairan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data pengairan.');
        }
    }
}