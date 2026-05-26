<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\LahanController;
use App\Http\Controllers\AuthController;
use App\Models\Lahan;   
use App\Models\BatchTanam; 
use App\Models\Penjualan;
use App\Models\KegiatanPerawatan;
use App\Http\Controllers\PemupukanController;
use App\Http\Controllers\PenanamanController;
use App\Http\Controllers\IrigasiController;
use App\Http\Controllers\HamaController;


// ==========================================
// ROUTE OTENTIKASI (Hanya untuk yang belum login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ==========================================
// ROUTE UTAMA (Wajib Login)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // Proses Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Utama
    Route::get('/', function () { 
        $lahans = \App\Models\Lahan::with('petani')->get();
        $totalLahan = $lahans->sum('luas_ha');

        // Ambil data batch aktif beserta relasi lahannya
        $batchesAktif = \App\Models\BatchTanam::with('lahan')->where('status', 'aktif')->orderBy('tanggal_tanam', 'desc')->get();
        $totalBatch = $batchesAktif->count(); 

        // Kalkulasi Sisa Hari Panen
        $estimasiPanen = null;
        foreach ($batchesAktif as $batch) {
            $tglPanen = \Carbon\Carbon::parse($batch->tanggal_tanam)->addDays($batch->durasi_standar_hari);
            $sisaHari = \Carbon\Carbon::now()->startOfDay()->diffInDays($tglPanen->startOfDay(), false);

            if ($sisaHari >= 0) {
                if (is_null($estimasiPanen) || $sisaHari < $estimasiPanen) {
                    $estimasiPanen = $sisaHari;
                }
            }
        }
        $estimasiPanen = $estimasiPanen ?? 0;

        // Menghitung pendapatan
        $totalPendapatanRaw = class_exists(\App\Models\Penjualan::class) ? \App\Models\Penjualan::sum('total_harga') : 0;
        if ($totalPendapatanRaw >= 1000000000) {
            $pendapatan = round($totalPendapatanRaw / 1000000000, 1) . 'B'; 
        } elseif ($totalPendapatanRaw >= 1000000) {
            $pendapatan = round($totalPendapatanRaw / 1000000, 1) . 'M'; 
        } elseif ($totalPendapatanRaw >= 1000) {
            $pendapatan = round($totalPendapatanRaw / 1000, 1) . 'K'; 
        } else {
            $pendapatan = number_format($totalPendapatanRaw, 0, ',', '.');
        }

        // Ambil jumlah notifikasi
        $jumlahNotif = \App\Models\BatchTanam::countNotifikasiPanen();

        return view('dashboard', compact(
            'lahans', 
            'totalLahan', 
            'totalBatch', 
            'estimasiPanen', 
            'pendapatan',
            'batchesAktif',
            'jumlahNotif'
        )); 
    })->name('dashboard');

    Route::get('/peta-gis', function () {
        $lahans = Lahan::with('petani')->get();
        return view('peta_gis', compact('lahans'));
    })->name('peta.gis');

    Route::get('/pemupukan', [PemupukanController::class, 'index'])->name('pemupukan');
    Route::post('/pemupukan', [PemupukanController::class, 'store'])->name('pemupukan.store');
    Route::get('/penanaman', [PenanamanController::class, 'index'])->name('penanaman');
    Route::post('/penanaman', [PenanamanController::class, 'store'])->name('penanaman.store');
    Route::get('/irigasi', [IrigasiController::class, 'index'])->name('irigasi');
    Route::post('/irigasi', [IrigasiController::class, 'store'])->name('irigasi.store');
    Route::get('/hama', [HamaController::class, 'index'])->name('hama');
    Route::post('/hama', [HamaController::class, 'store'])->name('hama.store');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/perawatan', [App\Http\Controllers\PerawatanController::class, 'index'])->name('perawatan');
    Route::post('/perawatan', [App\Http\Controllers\PerawatanController::class, 'store'])->name('perawatan.store');
    Route::get('/panen', [App\Http\Controllers\PanenController::class, 'index'])->name('panen');
    Route::post('/panen', [App\Http\Controllers\PanenController::class, 'store'])->name('panen.store');
    Route::get('/penjualan', [App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan');
    Route::post('/penjualan', [App\Http\Controllers\PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/penjualan/invoice/{id}', [App\Http\Controllers\PenjualanController::class, 'invoice'])->name('penjualan.invoice');
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');

    // Route Resource (Otomatis membuat rute CRUD untuk lahan)
    Route::resource('lahan', LahanController::class);

    // ----------------------------------------
    // UI Routes (Petani & Umum)
    // ----------------------------------------
    Route::get('/riwayat-batch', function () { return view('riwayat-batch'); });
    Route::get('/profil', function () { return view('profil'); });

    // ----------------------------------------
    // Distributor Routes
    // ----------------------------------------
    Route::get('/distributor/dashboard', function () { 
        return view('distributor.dashboard'); 
    });

    // ----------------------------------------
    // Admin Routes
    // ----------------------------------------
    Route::get('/admin/pengguna', function () { 
        return view('admin.pengguna'); 
    });

});