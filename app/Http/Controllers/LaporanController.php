<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\BatchTanam;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. KPI UTAMA (Kartu Atas)
        $totalPendapatan = class_exists(Penjualan::class) ? Penjualan::sum('total_harga') : 0;
        
        // Asumsi mengambil biaya dari tabel kegiatan_perawatan (dan tabel lain jika ada)
        $biayaPerawatan = \Illuminate\Support\Facades\Schema::hasTable('kegiatan_perawatan') 
            ? DB::table('kegiatan_perawatan')->sum('biaya') : 0;
        // Jika kamu punya tabel biaya pemupukan/hama, bisa ditambahkan di sini. 
        // Sementara kita gunakan biaya perawatan sebagai basis total biaya.
        $totalBiaya = $biayaPerawatan; 
        
        $labaBersih = $totalPendapatan - $totalBiaya;

        // 2. DATA CHART BAR (Pendapatan vs Biaya per Bulan)
        $bulanSekarang = Carbon::now()->month;
        $labelBulan = [];
        $dataPendapatanBulan = [];
        $dataBiayaBulan = [];
        $dataLabaBulan = [];

        // Ambil data 5 bulan terakhir agar grafiknya cantik seperti di desain
        for ($i = 4; $i >= 0; $i--) {
            $bulan = Carbon::now()->subMonths($i);
            $labelBulan[] = $bulan->translatedFormat('M'); // Jan, Feb, dst

            $pendapatan = Penjualan::whereMonth('tanggal', $bulan->month)
                ->whereYear('tanggal', $bulan->year)->sum('total_harga');
            
            // Simulasi/Ambil biaya per bulan
            $biaya = \Illuminate\Support\Facades\Schema::hasTable('kegiatan_perawatan') 
                ? DB::table('kegiatan_perawatan')->whereMonth('tanggal', $bulan->month)->whereYear('tanggal', $bulan->year)->sum('biaya') 
                : 0;

            $dataPendapatanBulan[] = $pendapatan;
            $dataBiayaBulan[] = $biaya;
            $dataLabaBulan[] = $pendapatan - $biaya;
        }

        // 3. DATA DOUGHNUT CHART (Komposisi Biaya)
        // Jika tabel spesifik belum lengkap, kita gunakan persentase dummy untuk visualisasi awal
        $komposisiBiaya = [
            'Pemupukan' => 35,
            'Pengendalian Hama' => 25,
            'Perawatan Lain' => 20,
            'Pengairan' => 20
        ];

        // 4. DATA TOP BATCH TERPROFITABEL
        // Mengambil batch aktif/selesai, diurutkan berdasarkan estimasi profit (Pendapatan dari batch tersebut)
        $topBatches = [];
        if (class_exists(BatchTanam::class) && \Illuminate\Support\Facades\Schema::hasTable('hasil_panen')) {
            $topBatches = DB::table('batch_tanam')
                ->join('hasil_panen', 'batch_tanam.id', '=', 'hasil_panen.batch_id')
                ->leftJoin('penjualan', 'hasil_panen.id', '=', 'penjualan.hasil_panen_id')
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