<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanPerawatan;
use Illuminate\Support\Facades\Auth;

class PerawatanController extends Controller
{
    public function index(Request $request)
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        $validBatchIds = \App\Models\BatchTanam::whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->pluck('id');

        $batches = \App\Models\BatchTanam::with('lahan')->whereIn('id', $validBatchIds)->where('status', 'aktif')->get(); 
        
        // =======================================================
        // LOGIKA FILTERING BERDASARKAN KLIK BATCH
        // =======================================================
        $selectedBatchId = $request->query('batch_id');

        if (!$selectedBatchId && $batches->isNotEmpty()) {
            $selectedBatchId = $batches->first()->id;
        }

        if ($selectedBatchId && $validBatchIds->contains($selectedBatchId)) {
            $riwayats = \App\Models\KegiatanPerawatan::where('batch_id', $selectedBatchId)->orderBy('tanggal', 'desc')->get();
        } else {
            $riwayats = collect();
        }

        $totalJam = $riwayats->sum('jumlah_jam');
        $totalBiaya = $riwayats->sum('biaya');

        return view('perawatan', compact('batches', 'riwayats', 'totalJam', 'totalBiaya', 'selectedBatchId'));
    }

    public function store(Request $request)
    {
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
            'biaya'      => $request->biaya, 
            'catatan'    => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data perawatan berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'   => 'required',
            'tanggal'    => 'required|date',
            'jenis'      => 'required|in:Penyiangan,Pemangkasan,Penopang,Penyulaman,Pembersihan Lahan,Lainnya',
            'jumlah_jam' => 'nullable|numeric',
            'price'      => 'nullable|numeric',
            'biaya'      => 'nullable|numeric',
        ]);

        $perawatan = KegiatanPerawatan::findOrFail($id); 
        
        $perawatan->update([
            'batch_id'   => $request->batch_id,
            'tanggal'    => $request->tanggal,
            'jenis'      => $request->jenis,
            'deskripsi'  => $request->deskripsi,
            'jumlah_jam' => $request->jumlah_jam,
            'price'      => $request->price,
            'biaya'      => $request->biaya, 
            'catatan'    => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data perawatan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $perawatan = KegiatanPerawatan::findOrFail($id);
            $perawatan->delete();
            return redirect()->back()->with('success', 'Data perawatan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data perawatan.');
        }
    }
}