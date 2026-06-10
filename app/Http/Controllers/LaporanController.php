<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\BatchTanam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        // ==========================================
        // REVISI DOSEN: INSIGHT PER TAHUN (FILTER)
        // ==========================================
        $tahunDipilih = $request->input('tahun', 'semua');
        
        // Ambil daftar tahun unik dari database untuk dropdown filter
        $daftarTahun = Schema::hasTable('batch_tanam') 
            ? DB::table('batch_tanam')->selectRaw('YEAR(tanggal_tanam) as tahun')->distinct()->orderByDesc('tahun')->pluck('tahun')->toArray()
            : [date('Y')];
        if(empty($daftarTahun)) $daftarTahun = [date('Y')];


        // ==========================================
        // 1. KPI UTAMA & TOTAL BIAYA (BERDASARKAN TAHUN)
        // ==========================================
        $queryPendapatan = Penjualan::whereHas('hasilPanen.batchTanam.lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        });
        if ($tahunDipilih !== 'semua') $queryPendapatan->whereYear('tanggal', $tahunDipilih);
        $totalPendapatan = class_exists(Penjualan::class) ? $queryPendapatan->sum('total_harga') : 0;
        
        $queryPerawatan = DB::table('kegiatan_perawatan')
            ->join('batch_tanam', 'kegiatan_perawatan.batch_id', '=', 'batch_tanam.id')
            ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
            ->where('lahan.petani_id', $userId);
        if ($tahunDipilih !== 'semua') $queryPerawatan->whereYear('kegiatan_perawatan.tanggal', $tahunDipilih);
        $biayaPerawatan = Schema::hasTable('kegiatan_perawatan') ? $queryPerawatan->sum('kegiatan_perawatan.biaya') : 0;

        $queryBibit = DB::table('batch_tanam')
            ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
            ->where('lahan.petani_id', $userId);
        if ($tahunDipilih !== 'semua') $queryBibit->whereYear('batch_tanam.tanggal_tanam', $tahunDipilih);
        $biayaBibit = Schema::hasColumn('batch_tanam', 'biaya_bibit') ? $queryBibit->sum('batch_tanam.biaya_bibit') : 0;

        $totalBiaya = $biayaPerawatan + $biayaBibit; 
        $labaBersih = $totalPendapatan - $totalBiaya;


        // ==========================================
        // 2. DATA CHART BAR (TREN BULANAN)
        // ==========================================
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
                ->whereYear('tanggal', $bulan->year)
                ->sum('total_harga');
            
            $biayaPerawatanBulan = Schema::hasTable('kegiatan_perawatan') 
                ? DB::table('kegiatan_perawatan')
                    ->join('batch_tanam', 'kegiatan_perawatan.batch_id', '=', 'batch_tanam.id')
                    ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                    ->where('lahan.petani_id', $userId)
                    ->whereMonth('kegiatan_perawatan.tanggal', $bulan->month)
                    ->whereYear('kegiatan_perawatan.tanggal', $bulan->year)
                    ->sum('kegiatan_perawatan.biaya') 
                : 0;

            $biayaBibitBulan = Schema::hasColumn('batch_tanam', 'biaya_bibit')
                ? DB::table('batch_tanam')
                    ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                    ->where('lahan.petani_id', $userId)
                    ->whereMonth('batch_tanam.tanggal_tanam', $bulan->month)
                    ->whereYear('batch_tanam.tanggal_tanam', $bulan->year)
                    ->sum('batch_tanam.biaya_bibit')
                : 0;

            $totalBiayaBulanIni = $biayaPerawatanBulan + $biayaBibitBulan;

            $dataPendapatanBulan[] = $pendapatan;
            $dataBiayaBulan[] = $totalBiayaBulanIni;
            $dataLabaBulan[] = $pendapatan - $totalBiayaBulanIni;
        }


        // ==========================================
        // 3. PERBANDINGAN PREDIKSI VS AKTUAL
        // ==========================================
        $labelCompareBatch = [];
        $dataPrediksiKg = [];
        $dataAktualKg = [];

        if (Schema::hasTable('hasil_panen')) {
            $batchSelesai = DB::table('batch_tanam')
                ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                ->join('hasil_panen', 'batch_tanam.id', '=', 'hasil_panen.batch_id')
                ->where('lahan.petani_id', $userId)
                ->select('batch_tanam.komoditas', 'batch_tanam.tanggal_tanam', 'lahan.luas_ha', 'hasil_panen.jumlah_kg as aktual_kg')
                ->orderBy('batch_tanam.tanggal_tanam', 'desc')
                ->take(5)
                ->get()
                ->reverse(); // Supaya urutan waktunya maju di grafik

            foreach ($batchSelesai as $bs) {
                $tgl = Carbon::parse($bs->tanggal_tanam)->translatedFormat('M y');
                $labelCompareBatch[] = $bs->komoditas . ' (' . $tgl . ')';
                $dataPrediksiKg[] = round($bs->luas_ha * 6000); // Prediksi 6 Ton/Ha
                $dataAktualKg[] = $bs->aktual_kg;
            }
        }


        // ==========================================
        // 4. KOMPOSISI BIAYA (DOUGHNUT CHART)
        // ==========================================
        $persenBibit = $totalBiaya > 0 ? round(($biayaBibit / $totalBiaya) * 100) : 0;
        $persenPerawatan = $totalBiaya > 0 ? round(($biayaPerawatan / $totalBiaya) * 100) : 0;

        $komposisiBiaya = [
            'Pembibitan' => $persenBibit,
            'Pemupukan' => 0, 
            'Pengendalian Hama' => 0, 
            'Perawatan Lain' => $persenPerawatan,
            'Pengairan' => 0
        ];

        if ($totalBiaya == 0) {
            $komposisiBiaya = ['Pembibitan' => 20, 'Pemupukan' => 25, 'Pengendalian Hama' => 20, 'Perawatan Lain' => 15, 'Pengairan' => 20];
        }


        // ==========================================
        // 5. TOP BATCH TERPROFITABEL
        // ==========================================
        $topBatches = [];
        if (class_exists(BatchTanam::class) && Schema::hasTable('hasil_panen')) {
            $topBatches = DB::table('batch_tanam')
                ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                ->join('hasil_panen', 'batch_tanam.id', '=', 'hasil_panen.batch_id')
                ->leftJoin('penjualan', 'hasil_panen.id', '=', 'penjualan.hasil_panen_id')
                ->where('lahan.petani_id', $userId)
                ->select('batch_tanam.komoditas', 'batch_tanam.tanggal_tanam', DB::raw('SUM(penjualan.total_harga) as total_revenue'))
                ->groupBy('batch_tanam.id', 'batch_tanam.komoditas', 'batch_tanam.tanggal_tanam')
                ->orderByDesc('total_revenue')
                ->limit(3)
                ->get();
        }

        // ==========================================
        // REVISI DOSEN: ANALISIS KEUNTUNGAN PER BATCH/LAHAN
        // ==========================================
        $analisisBatch = [];
        if (Schema::hasTable('batch_tanam')) {
            $queryBatch = DB::table('batch_tanam')
                ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id')
                ->where('lahan.petani_id', $userId)
                ->select('batch_tanam.id', 'batch_tanam.komoditas', 'batch_tanam.tanggal_tanam', 'batch_tanam.biaya_bibit', 'lahan.nama_lahan')
                ->orderBy('batch_tanam.tanggal_tanam', 'desc');
                
            if ($tahunDipilih !== 'semua') {
                $queryBatch->whereYear('batch_tanam.tanggal_tanam', $tahunDipilih);
            }
            
            $batches = $queryBatch->get();

            foreach ($batches as $b) {
                $pendapatanBatch = Schema::hasTable('penjualan') 
                    ? DB::table('penjualan')
                        ->join('hasil_panen', 'penjualan.hasil_panen_id', '=', 'hasil_panen.id')
                        ->where('hasil_panen.batch_id', $b->id)
                        ->sum('penjualan.total_harga')
                    : 0;

                $perawatanBatch = Schema::hasTable('kegiatan_perawatan')
                    ? DB::table('kegiatan_perawatan')
                        ->where('batch_id', $b->id)
                        ->sum('biaya')
                    : 0;

                $biayaTotalBatch = $perawatanBatch + ($b->biaya_bibit ?? 0);
                $labaBatch = $pendapatanBatch - $biayaTotalBatch;

                $status = 'Proses';
                if ($pendapatanBatch > 0) {
                    $status = $labaBatch > 0 ? 'Untung' : ($labaBatch < 0 ? 'Rugi' : 'Impas');
                }

                $analisisBatch[] = (object) [
                    'komoditas' => $b->komoditas,
                    'lahan' => $b->nama_lahan,
                    'tanggal' => $b->tanggal_tanam,
                    'pendapatan' => $pendapatanBatch,
                    'biaya' => $biayaTotalBatch,
                    'laba' => $labaBatch,
                    'status' => $status,
                ];
            }
        }

        return view('laporan', compact(
            'totalPendapatan', 'totalBiaya', 'labaBersih',
            'labelBulan', 'dataPendapatanBulan', 'dataBiayaBulan', 'dataLabaBulan',
            'labelCompareBatch', 'dataPrediksiKg', 'dataAktualKg',
            'komposisiBiaya', 'topBatches',
            'daftarTahun', 'tahunDipilih', 'analisisBatch' // Data Baru Dikirim
        ));
    }
}