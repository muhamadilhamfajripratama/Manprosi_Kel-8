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
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PerawatanController;


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

    Route::get('/profil', function () {
        return view('profil');
    })->name('profil');

    Route::put('/profil', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Data profil berhasil diperbarui!');
    })->name('profil.update');

    Route::get('/pemupukan', [PemupukanController::class, 'index'])->name('pemupukan');
    Route::post('/pemupukan', [PemupukanController::class, 'store'])->name('pemupukan.store');
    Route::put('/pemupukan/{id}', [App\Http\Controllers\PemupukanController::class, 'update'])->name('pemupukan.update');
    Route::delete('/pemupukan/{id}', [App\Http\Controllers\PemupukanController::class, 'destroy'])->name('pemupukan.destroy');
    Route::get('/penanaman', [PenanamanController::class, 'index'])->name('penanaman');
    Route::post('/penanaman', [PenanamanController::class, 'store'])->name('penanaman.store');
    Route::put('/penanaman/{id}', [PenanamanController::class, 'update'])->name('penanaman.update');
    Route::delete('/penanaman/{id}', [PenanamanController::class, 'destroy'])->name('penanaman.destroy');
    Route::get('/penanaman/detail/{id}', [PenanamanController::class, 'show'])->name('penanaman.detail');
    Route::get('/irigasi', [IrigasiController::class, 'index'])->name('irigasi');
    Route::post('/irigasi', [IrigasiController::class, 'store'])->name('irigasi.store');
    Route::put('/irigasi/{id}', [IrigasiController::class, 'update'])->name('irigasi.update');
    Route::delete('/irigasi/{id}', [IrigasiController::class, 'destroy'])->name('irigasi.destroy');
    Route::get('/hama', [HamaController::class, 'index'])->name('hama');
    Route::post('/hama', [HamaController::class, 'store'])->name('hama.store');
    Route::put('/hama/{id}', [HamaController::class, 'update'])->name('hama.update');
    Route::delete('/hama/{id}', [HamaController::class, 'destroy'])->name('hama.destroy');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
    Route::get('/perawatan', [App\Http\Controllers\PerawatanController::class, 'index'])->name('perawatan');
    Route::post('/perawatan', [App\Http\Controllers\PerawatanController::class, 'store'])->name('perawatan.store');
    Route::put('/perawatan/{id}', [PerawatanController::class, 'update'])->name('perawatan.update');
    Route::delete('/perawatan/{id}', [PerawatanController::class, 'destroy'])->name('perawatan.destroy');
    Route::get('/panen', [App\Http\Controllers\PanenController::class, 'index'])->name('panen');
    Route::post('/panen', [App\Http\Controllers\PanenController::class, 'store'])->name('panen.store');
    Route::put('/panen/{id}', [PanenController::class, 'update'])->name('panen.update');
    Route::delete('/panen/{id}', [PanenController::class, 'destroy'])->name('panen.destroy');
    Route::get('/penjualan', [App\Http\Controllers\PenjualanController::class, 'index'])->name('penjualan');
    Route::post('/penjualan', [App\Http\Controllers\PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('/penjualan/invoice/{id}', [App\Http\Controllers\PenjualanController::class, 'invoice'])->name('penjualan.invoice');
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');
    Route::get('/jadwal', [App\Http\Controllers\JadwalController::class, 'index'])->name('jadwal');
    
    // Route Resource (Otomatis membuat rute CRUD untuk lahan)
    Route::resource('lahan', LahanController::class);

    // ----------------------------------------
    // UI Routes (Petani & Umum)
    // ----------------------------------------
    Route::get('/riwayat-batch', function () { return view('riwayat-batch'); });

    // ----------------------------------------
    // Distributor Routes
    // ----------------------------------------
    Route::get('/distributor/dashboard', function () { 
        // Ambil semua data lahan beserta info petaninya
        $lahans = \App\Models\Lahan::with('petani')->get();
        return view('distributor.dashboard', compact('lahans')); 
    })->name('distributor.dashboard');

    // Rute Baru: Pembelian Panen
    Route::get('/distributor/pembelian', function () { 
        return view('distributor.pembelian'); 
    })->name('distributor.pembelian');

    // Rute Baru: Daftar Mitra Petani
    Route::get('/distributor/mitra', function () { 
        return view('distributor.mitra'); 
    })->name('distributor.mitra');

    // ----------------------------------------
    // Admin Routes
    // ----------------------------------------
    Route::get('/admin/pengguna', function () { 
        return view('admin.pengguna'); 
    });

});