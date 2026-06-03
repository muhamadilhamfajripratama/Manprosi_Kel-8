<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\HasilPanen;
use App\Models\BatchTanam;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
public function index()
    {
        $userId = Auth::id();

        // 1. Ambil data stok panen milik user
        $panens = HasilPanen::with('batchTanam')
            ->whereHas('batchTanam.lahan', function($q) use ($userId) {
                $q->where('petani_id', $userId);
            })
            ->whereRaw('jumlah_kg - (SELECT COALESCE(SUM(jumlah_kg), 0) FROM penjualan WHERE penjualan.hasil_panen_id = hasil_panen.id) > 0')
            ->get();

        // 2. Hitung metrik dari SELURUH data penjualan milik user
        $totalPendapatan = Penjualan::whereHas('hasilPanen.batchTanam.lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->sum('total_harga');

        $totalTransaksi = Penjualan::whereHas('hasilPanen.batchTanam.lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->count();

        // 3. Cari Komoditas Terlaris (FIXED: Tabel lahan tanpa 's')
        $terlaris = Penjualan::selectRaw('hasil_panen.komoditas, SUM(penjualan.jumlah_kg) as total_kg')
            ->join('hasil_panen', 'penjualan.hasil_panen_id', '=', 'hasil_panen.id')
            ->join('batch_tanam', 'hasil_panen.batch_id', '=', 'batch_tanam.id')
            ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
            ->where('lahan.petani_id', $userId)
            ->groupBy('hasil_panen.komoditas')
            ->orderByDesc('total_kg')
            ->first();
        $komoditasTerlaris = $terlaris ? $terlaris->komoditas : 'Belum ada data';

        // 4. Riwayat Penjualan 
        $riwayats = Penjualan::with('hasilPanen.batchTanam')
            ->whereHas('hasilPanen.batchTanam.lahan', function($q) use ($userId) {
                $q->where('petani_id', $userId);
            })
            ->orderBy('tanggal', 'desc')->paginate(10);
        
        $subtotalKg = $riwayats->sum('jumlah_kg');
        $subtotalRp = $riwayats->sum('total_harga');

        return view('penjualan', compact('panens', 'riwayats', 'totalPendapatan', 'totalTransaksi', 'komoditasTerlaris', 'subtotalKg', 'subtotalRp'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hasil_panen_id' => 'required',
            'tanggal'        => 'required|date',
            'nama_pembeli'   => 'required|string|max:255',
            'jumlah_kg'      => 'required|numeric|min:0.1',
            'harga_per_kg'   => 'required|numeric|min:1',
        ]);

        $panen = HasilPanen::findOrFail($request->hasil_panen_id);

        if ($request->jumlah_kg > $panen->sisa_stok) {
            return redirect()->back()->with('error', "Gagal! Stok tersisa hanya {$panen->sisa_stok} kg.");
        }

        $total_harga = $request->jumlah_kg * $request->harga_per_kg;

        Penjualan::create([
            'hasil_panen_id' => $request->hasil_panen_id,
            'tanggal'        => $request->tanggal,
            'nama_pembeli'   => $request->nama_pembeli,
            'jumlah_kg'      => $request->jumlah_kg,
            'harga_per_kg'   => $request->harga_per_kg,
            'total_harga'    => $total_harga,
            'catatan'        => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Transaksi penjualan berhasil dicatat!');
    }

    public function invoice($id)
    {
        $transaksi = Penjualan::with('hasilPanen.batchTanam.lahan')->findOrFail($id);
        $invoice = Invoice::where('id_penjualan', $transaksi->id)->first();

        if (!$invoice) {
            $invoice = Invoice::create([
                'id_penjualan'  => $transaksi->id,
                'nomor_invoice' => 'INV-' . date('Ymd') . '-' . str_pad($transaksi->id, 4, '0', STR_PAD_LEFT),
                'tanggal_cetak' => now()->format('Y-m-d'),
                'catatan'       => 'Dicetak otomatis oleh sistem.'
            ]);
        }

        return view('invoice', compact('transaksi', 'invoice'));
    }
}