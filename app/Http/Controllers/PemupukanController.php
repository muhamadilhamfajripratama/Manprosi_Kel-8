<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam; 
use App\Models\KegiatanPemupukan;

class PemupukanController extends Controller
{
    // Menampilkan halaman dan mengambil data dari database
    public function index()
    {
        // Cukup panggil BatchTanam langsung
        $batches = BatchTanam::with('lahan')->where('status', 'aktif')->get(); 
        
        // Cukup panggil KegiatanPemupukan langsung
        $riwayats = KegiatanPemupukan::orderBy('tanggal', 'desc')->get();

        // HITUNG STATISTIK ASLI (Responsif)
        $totalBiaya = $riwayats->sum(function ($item) {
            return $item->total_biaya; // Memanggil accessor dari Model
        });
        $totalPemupukan = $riwayats->count(); // Menghitung total baris

        // Kirim semuanya ke view
        return view('pemupukan', compact('batches', 'riwayats', 'totalBiaya', 'totalPemupukan'));
    }

    // Menyimpan data saat tombol di modal diklik
    public function store(Request $request)
    {
        // 1. SATPAM VALIDASI: Mencegah crash jika data kosong
        $request->validate([
            'batch_id'    => 'required',
            'tanggal'     => 'required|date',
            'jenis_pupuk' => 'required|string',
            'dosis'       => 'required|numeric',
            'harga_beli'  => 'required|numeric', 
        ], [
            // Pesan error kustom jika kosong
            'batch_id.required'   => 'Kamu harus memilih Batch Tanam terlebih dahulu!',
            'harga_beli.required' => 'Harga beli pupuk tidak boleh kosong!',
        ]);

        // 2. Jika lolos validasi, baru simpan ke database
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

    // Mengupdate data saat tombol simpan edit diklik
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

    // Menghapus data saat konfirmasi SweetAlert disetujui
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