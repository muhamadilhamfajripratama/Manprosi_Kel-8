<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\BatchTanam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanController extends Controller
{
public function index()
    {
        $userId = Auth::id();

        // 1. KPI UTAMA (Dikunci untuk User Login)
        $totalPendapatan = class_exists(Penjualan::class) 
            ? Penjualan::whereHas('hasilPanen.batchTanam.lahan', function($q) use ($userId) {
                $q->where('petani_id', $userId);
            })->sum('total_harga') 
            : 0;
        
        // FIXED: Tabel lahan tanpa 's'
        $biayaPerawatan = \Illuminate\Support\Facades\Schema::hasTable('kegiatan_perawatan') 
            ? DB::table('kegiatan_perawatan')
                ->join('batch_tanam', 'kegiatan_perawatan.batch_id', '=', 'batch_tanam.id')
                ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                ->where('lahan.petani_id', $userId)
                ->sum('kegiatan_perawatan.biaya') 
            : 0;
            
        $totalBiaya = $biayaPerawatan; 
        $labaBersih = $totalPendapatan - $totalBiaya;

        // 2. DATA CHART BAR
        $labelBulan = [];
        $dataPendapatanBulan = [];
        $dataBiayaBulan = [];
        $dataLabaBulan = [];

        for ($i = 4; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $labelBulan[] = $bulan->translatedFormat('M'); 

            $pendapatan = Penjualan::whereHas('hasilPanen.batchTanam.lahan', function($q) use ($userId) {
                    $q->where('petani_id', $userId);
                })
                ->whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)->sum('total_harga');
            
            // FIXED: Tabel lahan tanpa 's'
            $biaya = \Illuminate\Support\Facades\Schema::hasTable('kegiatan_perawatan') 
                ? DB::table('kegiatan_perawatan')
                    ->join('batch_tanam', 'kegiatan_perawatan.batch_id', '=', 'batch_tanam.id')
                    ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                    ->where('lahan.petani_id', $userId)
                    ->whereMonth('kegiatan_perawatan.tanggal', $bulan->month)
                    ->whereYear('kegiatan_perawatan.tanggal', $bulan->year)
                    ->sum('kegiatan_perawatan.biaya') 
                : 0;

            $dataPendapatanBulan[] = $pendapatan;
            $dataBiayaBulan[] = $biaya;
            $dataLabaBulan[] = $pendapatan - $biaya;
        }

        // 3. KOMPOSISI BIAYA (Dummy Visualisasi Awal)
        $komposisiBiaya = [
            'Pemupukan' => 35,
            'Pengendalian Hama' => 25,
            'Perawatan Lain' => 20,
            'Pengairan' => 20
        ];

        // 4. TOP BATCH TERPROFITABEL (Dikunci untuk User Login)
        // FIXED: Tabel lahan tanpa 's'
        $topBatches = [];
        if (class_exists(BatchTanam::class) && \Illuminate\Support\Facades\Schema::hasTable('hasil_panen')) {
            $topBatches = DB::table('batch_tanam')
                ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                ->join('hasil_panen', 'batch_tanam.id', '=', 'hasil_panen.batch_id')
                ->leftJoin('penjualan', 'hasil_panen.id', '=', 'penjualan.hasil_panen_id')
                ->where('lahan.petani_id', $userId)
                ->select(
                    'batch_tanam.komoditas',
                    'batch_tanam.tanggal_tanam',
                    DB::raw('SUM(penjualan.total_harga) as total_revenue')
                )
                ->groupBy('batch_tanam.id', 'batch_tanam.komoditas', 'batch_tanam.tanggal_tanam')
                ->orderByDesc('total_revenue')
                ->limit(3)
                ->get();
        }

        return view('laporan', compact(
            'totalPendapatan', 'totalBiaya', 'labaBersih',
            'labelBulan', 'dataPendapatanBulan', 'dataBiayaBulan', 'dataLabaBulan',
            'komposisiBiaya', 'topBatches'
        ));
    }
}