<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanIrigasi;
use Illuminate\Support\Facades\Auth;

class IrigasiController extends Controller
{
    public function index(Request $request)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        // 1. Ambil ID batch yang valid milik user ini
        $validBatchIds = \App\Models\BatchTanam::whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->pluck('id');

        // 2. Tampilkan semua batch aktif di list sebelah kiri
        $batches = \App\Models\BatchTanam::with('lahan')->whereIn('id', $validBatchIds)->where('status', 'aktif')->get(); 
        
        // =======================================================
        // LOGIKA FILTERING BERDASARKAN KLIK BATCH
        // =======================================================
        $selectedBatchId = $request->query('batch_id');

        // Jika tidak ada batch yang diklik, otomatis pilih batch pertama (jika ada)
        if (!$selectedBatchId && $batches->isNotEmpty()) {
            $selectedBatchId = $batches->first()->id;
        }

        // 3. Filter riwayat hanya untuk batch yang terpilih
        if ($selectedBatchId && $validBatchIds->contains($selectedBatchId)) {
            $riwayats = \App\Models\KegiatanIrigasi::where('batch_id', $selectedBatchId)->orderBy('tanggal', 'desc')->get();
        } else {
            $riwayats = collect(); // Kosongkan jika tidak ada
        }

        // 4. Kalkulasi total khusus untuk batch yang terpilih
        $totalDebit = $riwayats->sum('debit_liter');
        $totalIrigasi = $riwayats->count(); 

        // Lempar $selectedBatchId ke view agar kotak yang diklik bisa diberi warna aktif
        return view('irigasi', compact('batches', 'riwayats', 'totalDebit', 'totalIrigasi', 'selectedBatchId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'         => 'required',
            'tanggal'          => 'required|date',
            'debit_liter'      => 'required|numeric',
            'sumber_pengairan' => 'nullable|string', 
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'         => 'required',
            'tanggal'          => 'required|date',
            'debit_liter'      => 'required|numeric',
            'sumber_pengairan' => 'required|string',
        ]);

        $irigasi = \App\Models\KegiatanIrigasi::findOrFail($id);
        
        $irigasi->update([
            'batch_id'         => $request->batch_id,
            'tanggal'          => $request->tanggal,
            'debit_liter'      => $request->debit_liter,
            'sumber_pengairan' => $request->sumber_pengairan,
            'catatan'          => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pengairan berhasil diperbarui!');
    }

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