<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\HasilPanen;
use Carbon\Carbon;

class PanenController extends Controller
{
    public function index()
    {
        // PERBAIKAN: Ambil status 'aktif' dan 'selesai' agar opsi lama tidak hilang saat mau di-edit
        $batches = \App\Models\BatchTanam::with('lahan')->whereIn('status', ['aktif', 'selesai'])->get();
        $riwayats = \App\Models\HasilPanen::with('batchTanam')->orderBy('tanggal_panen', 'desc')->get();

        return view('panen', compact('batches', 'riwayats'));
    }

    public function store(Request $request)
    {
        // Validasi disesuaikan dengan Enum di database
        $request->validate([
            'batch_id'      => 'required',
            'tanggal_panen' => 'required|date',
            'jumlah_kg'     => 'required|numeric|min:1',
            'kualitas'      => 'required|in:Grade A,Grade B,Grade C',
        ]);

        $batch = BatchTanam::findOrFail($request->batch_id);
        
        // Kalkulasi Umur
        $tglTanam = Carbon::parse($batch->tanggal_tanam)->startOfDay();
        $tglPanen = Carbon::parse($request->tanggal_panen)->startOfDay();
        $umurAktual = $tglTanam->diffInDays($tglPanen, false);
        
        // Blokir jika umur belum mencukupi standar panen
        if ($umurAktual < $batch->durasi_standar_hari) {
            $kurang = $batch->durasi_standar_hari - $umurAktual;
            return redirect()->back()->with('error', "Validasi Gagal! Tanaman belum cukup umur. Masih kurang $kurang hari lagi.");
        }

        // Simpan data beserta komoditas dan umur panen otomatis
        HasilPanen::create([
            'batch_id'        => $request->batch_id,
            'tanggal_panen'   => $request->tanggal_panen,
            'jumlah_kg'       => $request->jumlah_kg,
            'komoditas'       => $batch->komoditas,     // Diambil otomatis dari relasi batch
            'kualitas'        => $request->kualitas,
            'umur_panen_hari' => $umurAktual,           // Diambil dari hasil hitungan
            'catatan'         => $request->catatan,
        ]);

        // Opsional: Tutup status batch agar tidak bisa dipanen dua kali
        $batch->update(['status' => 'selesai']);

        return redirect()->back()->with('success', 'Hasil panen berhasil dicatat!');
    }

    // FUNGSI UPDATE DATA (BARU)
    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'      => 'required',
            'tanggal_panen' => 'required|date',
            'jumlah_kg'     => 'required|numeric|min:1',
            'kualitas'      => 'required|in:Grade A,Grade B,Grade C',
        ]);

        $panen = HasilPanen::findOrFail($id);
        $batch = BatchTanam::findOrFail($request->batch_id);
        
        // Kalkulasi Ulang Umur Tanaman
        $tglTanam = Carbon::parse($batch->tanggal_tanam)->startOfDay();
        $tglPanen = Carbon::parse($request->tanggal_panen)->startOfDay();
        $umurAktual = $tglTanam->diffInDays($tglPanen, false);
        
        // Jalankan Satpam Validasi Umur kembali
        if ($umurAktual < $batch->durasi_standar_hari) {
            $kurang = $batch->durasi_standar_hari - $umurAktual;
            return redirect()->back()->with('error', "Validasi Gagal! Perubahan tanggal membuat umur tanaman kurang $kurang hari dari durasi standar.");
        }

        // Jika user mengubah pilihan Batch Tanam, kembalikan status batch lama menjadi aktif kembali
        if ($panen->batch_id != $request->batch_id) {
            BatchTanam::where('id', $panen->batch_id)->update(['status' => 'aktif']);
        }

        $panen->update([
            'batch_id'        => $request->batch_id,
            'tanggal_panen'   => $request->tanggal_panen,
            'jumlah_kg'       => $request->jumlah_kg,
            'komoditas'       => $batch->komoditas,
            'kualitas'        => $request->kualitas,
            'umur_panen_hari' => $umurAktual,
            'catatan'         => $request->catatan,
        ]);

        // Kunci status batch yang baru dipilih menjadi selesai
        $batch->update(['status' => 'selesai']);

        return redirect()->back()->with('success', 'Data hasil panen berhasil diperbarui!');
    }

    // FUNGSI HAPUS DATA (BARU)
    public function destroy($id)
    {
        try {
            $panen = HasilPanen::findOrFail($id);
            
            // Kembalikan status Batch Tanam menjadi aktif kembali agar bisa dikelola/dipanen ulang
            BatchTanam::where('id', $panen->batch_id)->update(['status' => 'aktif']);
            
            $panen->delete();
            
            return redirect()->back()->with('success', 'Data hasil panen berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data hasil panen.');
        }
    }
}