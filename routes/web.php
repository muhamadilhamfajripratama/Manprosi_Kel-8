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
        $lahans = App\Models\Lahan::with('petani')->get();
        $totalLahan = $lahans->sum('luas_ha');

        // 2. Mengambil total Batch Tanaman yang berstatus masih aktif secara otomatis
        // Jaring Pengaman: Jika class model/tabel belum dibuat, sistem otomatis mengembalikan angka 0 agar tidak error crashing
        $totalBatch = class_exists(\App\Models\BatchPenanaman::class) 
            ? \App\Models\BatchPenanaman::where('status', 'aktif')->count() 
            : 0; 

        // 3. Mengambil sisa hari terdekat menuju estimasi panen dari batch tanaman yang ada
        // Menggunakan nilai minimum dari kolom sisa_hari_panen di database
        $estimasiPanen = class_exists(\App\Models\BatchPenanaman::class)
            ? (\App\Models\BatchPenanaman::where('status', 'aktif')->min('sisa_hari_panen') ?? 0)
            : 0;

        // 4. Menghitung otomatis total nominal omzet penjualan hasil panen dari database
        $totalPendapatanRaw = class_exists(\App\Models\Penjualan::class)
            ? \App\Models\Penjualan::sum('total_harga')
            : 0;

        // MENGUBAH FORMAT NOMINAL ANGKA MENJADI FORMAT RINGKAS (Contoh: 24500000 menjadi 24.5M)
        if ($totalPendapatanRaw >= 1000000000) {
            $pendapatan = round($totalPendapatanRaw / 1000000000, 1) . 'B'; // Billion / Miliar
        } elseif ($totalPendapatanRaw >= 1000000) {
            $pendapatan = round($totalPendapatanRaw / 1000000, 1) . 'M'; // Million / Juta
        } elseif ($totalPendapatanRaw >= 1000) {
            $pendapatan = round($totalPendapatanRaw / 1000, 1) . 'K'; // Thousand / Ribu
        } else {
            $pendapatan = number_format($totalPendapatanRaw, 0, ',', '.');
        }

        return view('dashboard', compact(
            'lahans', 
            'totalLahan', 
            'totalBatch', 
            'estimasiPanen', 
            'pendapatan'
        )); 
    })->name('dashboard');

    Route::get('/peta-gis', function () {
        $lahans = \App\Models\Lahan::with('petani')->get();
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

    // Route Resource (Otomatis membuat rute CRUD untuk lahan)
    Route::resource('lahan', LahanController::class);

    // ----------------------------------------
    // UI Routes (Petani & Umum)
    // ----------------------------------------
    Route::get('/perawatan', function () { return view('perawatan'); });
    Route::get('/panen', function () { return view('panen'); });
    Route::get('/penjualan', function () { return view('penjualan'); });
    Route::get('/laporan', function () { return view('laporan'); });
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