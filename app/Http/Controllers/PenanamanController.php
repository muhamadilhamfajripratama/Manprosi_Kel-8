<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\Lahan;
use Illuminate\Support\Facades\Auth;

class PenanamanController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // TAMBAHKAN INI AGAR TIDAK ERROR
        
        $batches = BatchTanam::with('lahan')->whereHas('lahan', function($query) use ($userId) {
            $query->where('petani_id', $userId);
        })->get();
        
        $lahans = Lahan::where('petani_id', $userId)->get(); 

        return view('penanaman', compact('batches', 'lahans'));
    }

    public function store(Request $request)
    {
        BatchTanam::create([
            'lahan_id'            => $request->lahan_id,
            'petani_id'           => Auth::id(), 
            'komoditas'           => $request->komoditas,
            'tanggal_tanam'       => $request->tanggal_tanam,
            'asal_bibit'          => $request->asal_bibit,
            'jumlah_bibit'        => $request->jumlah_bibit,
            'satuan_bibit'        => $request->satuan_bibit,
            'jarak_tanam_cm'      => $request->jarak_tanam_cm,
            'metode_tanam'        => $request->metode_tanam,
            'durasi_standar_hari' => $request->durasi_standar_hari,
            'catatan'             => $request->catatan,
            'status'              => 'aktif',
        ]);

        return redirect()->back()->with('success', 'Proses penanaman baru berhasil dimulai!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'lahan_id'            => 'required',
            'komoditas'           => 'required|string',
            'tanggal_tanam'       => 'required|date',
            'asal_bibit'          => 'nullable|string',
            'jumlah_bibit'        => 'nullable|numeric',
            'satuan_bibit'        => 'nullable|string',
            'jarak_tanam_cm'      => 'nullable|string',
            'metode_tanam'        => 'nullable|string',
            'durasi_standar_hari' => 'nullable|numeric',
        ]);

        $batch = BatchTanam::findOrFail($id);
        
        $batch->update([
            'lahan_id'            => $request->lahan_id,
            'komoditas'           => $request->komoditas,
            'tanggal_tanam'       => $request->tanggal_tanam,
            'asal_bibit'          => $request->asal_bibit,
            'jumlah_bibit'        => $request->jumlah_bibit,
            'satuan_bibit'        => $request->satuan_bibit,
            'jarak_tanam_cm'      => $request->jarak_tanam_cm,
            'metode_tanam'        => $request->metode_tanam,
            'durasi_standar_hari' => $request->durasi_standar_hari,
            'catatan'             => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data penanaman berhasil diperbarui!');
    }

    public function show($id)
    {
        $batch = \App\Models\BatchTanam::with('lahan')->findOrFail($id);

        $dataIrigasi   = \App\Models\KegiatanIrigasi::where('batch_id', $id)->get();
        $dataPerawatan = \App\Models\KegiatanPerawatan::where('batch_id', $id)->get();
        $dataPemupukan = \App\Models\KegiatanPemupukan::where('batch_id', $id)->get();
        $dataHama      = \App\Models\KegiatanHama::where('batch_id', $id)->get();

        $totalBiayaPerawatan = $dataPerawatan->sum('biaya'); 
        
        $totalBiayaPupuk = $dataPemupukan->sum(function ($item) {
            return $item->total_biaya; 
        });
        
        $totalBiayaHama = $dataHama->sum(function ($item) {
            return $item->total_biaya; 
        });
        
        $totalBiayaKeseluruhan = $totalBiayaPerawatan + $totalBiayaPupuk + $totalBiayaHama;
        
        $irigasi = $dataIrigasi->map(function($item) {
            return [
                'tanggal'   => $item->tanggal,
                'tipe'      => 'Pengairan / Irigasi',
                'ikon'      => 'ph-drop text-blue-500',
                'bg'        => 'bg-blue-50',
                'deskripsi' => 'Menyiram ' . ($item->debit_liter ?? 0) . ' Liter air (' . ($item->sumber_pengairan ?? 'Sumber tidak dicatat') . ')'
            ];
        });

        $perawatan = $dataPerawatan->map(function($item) {
            return [
                'tanggal'   => $item->tanggal,
                'tipe'      => 'Perawatan: ' . $item->jenis,
                'ikon'      => 'ph-wrench text-amber-500',
                'bg'        => 'bg-amber-50',
                'deskripsi' => $item->deskripsi ?? 'Melakukan kegiatan ' . $item->jenis
            ];
        });

        $pemupukan = $dataPemupukan->map(function($item) {
            return [
                'tanggal'   => $item->tanggal,
                'tipe'      => 'Pemupukan',
                'ikon'      => 'ph-flask text-green-500',
                'bg'        => 'bg-green-50',
                'deskripsi' => 'Memberikan pupuk ' . ($item->jenis_pupuk ?? '') . ' sebanyak ' . ($item->dosis ?? 0) . ' ' . ($item->satuan ?? 'Kg')
            ];
        });

        $hama = $dataHama->map(function($item) {
            return [
                'tanggal'   => $item->tanggal,
                'tipe'      => 'Pengendalian Hama',
                'ikon'      => 'ph-bug text-red-500',
                'bg'        => 'bg-red-50',
                'deskripsi' => 'Pengecekan hama: ' . ($item->jenis_hama ?? 'Aman') . ' (Kondisi: ' . ($item->tingkat_keparahan ?? 'Ringan') . ')'
            ];
        });

        $timeline = collect([])
            ->concat($irigasi)
            ->concat($perawatan)
            ->concat($pemupukan)
            ->concat($hama)
            ->sortByDesc('tanggal')
            ->values();

        return view('detail-penanaman', compact(
            'batch', 'totalBiayaKeseluruhan', 'totalBiayaPerawatan', 'totalBiayaPupuk', 'totalBiayaHama', 'timeline'
        ));
    }

    public function destroy($id)
    {
        try {
            $batch = BatchTanam::findOrFail($id);
            $batch->delete();
            return redirect()->back()->with('success', 'Data penanaman berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus! Pastikan data batch ini tidak sedang digunakan di riwayat perawatan atau panen.');
        }
    }
}