<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam; 
use App\Models\KegiatanPemupukan;
use Illuminate\Support\Facades\Auth;

class PemupukanController extends Controller
{
public function index()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        // Ambil kumpulan ID Batch yang sah milik petani ini
        $validBatchIds = \App\Models\BatchTanam::whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->pluck('id');

        $batches = \App\Models\BatchTanam::with('lahan')->whereIn('id', $validBatchIds)->where('status', 'aktif')->get(); 
        
        $riwayats = \App\Models\KegiatanPemupukan::whereIn('batch_id', $validBatchIds)->orderBy('tanggal', 'desc')->get();

        $totalBiaya = $riwayats->sum(function ($item) {
            return $item->total_biaya; 
        });
        $totalPemupukan = $riwayats->count(); 

        return view('pemupukan', compact('batches', 'riwayats', 'totalBiaya', 'totalPemupukan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'    => 'required',
            'tanggal'     => 'required|date',
            'jenis_pupuk' => 'required|string',
            'dosis'       => 'required|numeric',
            'harga_beli'  => 'required|numeric', 
        ], [
            'batch_id.required'   => 'Kamu harus memilih Batch Tanam terlebih dahulu!',
            'harga_beli.required' => 'Harga beli pupuk tidak boleh kosong!',
        ]);

        KegiatanPemupukan::create([
            'batch_id'    => $request->batch_id,
            'tanggal'     => $request->tanggal,
            'jenis_pupuk' => $request->jenis_pupuk,
            'dosis'       => $request->dosis,
            'satuan'      => $request->satuan ?? 'Kg',
            'harga_beli'  => $request->harga_beli,
            'nomide'      => $request->nomide,
            'catatan'     => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pemupukan berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal'     => 'required|date',
            'jenis_pupuk' => 'required|string',
            'dosis'       => 'required|numeric',
            'harga_beli'  => 'required|numeric',
        ]);

        $pemupukan = KegiatanPemupukan::findOrFail($id);

        $pemupukan->update([
            'tanggal'     => $request->tanggal,
            'jenis_pupuk' => $request->jenis_pupuk,
            'dosis'       => $request->dosis,
            'satuan'      => $request->satuan ?? 'Kg',
            'harga_beli'  => $request->harga_beli,
            'nomide'      => $request->nomide,
            'catatan'     => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pemupukan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $pemupukan = KegiatanPemupukan::findOrFail($id);
            $pemupukan->delete();
            return redirect()->back()->with('success', 'Data pemupukan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}