<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanHama;
use Illuminate\Support\Facades\Auth;

class HamaController extends Controller
{
public function index()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        $validBatchIds = \App\Models\BatchTanam::whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->pluck('id');

        $batches = \App\Models\BatchTanam::with('lahan')->whereIn('id', $validBatchIds)->where('status', 'aktif')->get(); 
        
        $riwayats = \App\Models\KegiatanHama::whereIn('batch_id', $validBatchIds)->orderBy('tanggal', 'desc')->get();

        $totalTindakan = $riwayats->count();
        $totalBiaya = $riwayats->sum(function ($item) {
            return $item->total_biaya;
        });

        return view('hama', compact('batches', 'riwayats', 'totalTindakan', 'totalBiaya'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'            => 'required',
            'tanggal'             => 'required|date',
            'jenis_hama'          => 'required|string',
            'tingkat_keparahan'   => 'required|in:Ringan,Sedang,Berat', 
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'            => 'required',
            'tanggal'             => 'required|date',
            'jenis_hama'          => 'required|string',
            'tingkat_keparahan'   => 'required|in:Ringan,Sedang,Berat',
            'metode_pengendalian' => 'required|string',
            'bahan_pengendalian'  => 'required|string',
            'dosis'               => 'required|numeric',
            'satuan'              => 'required|string',
            'harga_beli'          => 'required|numeric',
        ]);

        $hama = KegiatanHama::findOrFail($id);

        $hama->update([
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

        return redirect()->back()->with('success', 'Data pengendalian hama berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $hama = KegiatanHama::findOrFail($id);
            $hama->delete();
            return redirect()->back()->with('success', 'Data pengendalian hama berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data pengendalian hama.');
        }
    }
}