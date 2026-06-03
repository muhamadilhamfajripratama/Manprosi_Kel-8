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
        // Ambil ID user yang sedang login
        $userId = \Illuminate\Support\Facades\Auth::id();

        // 1. Ambil data lahan HANYA milik user ini
        $lahans = \App\Models\Lahan::with('petani')->where('petani_id', $userId)->get();
        $totalLahan = $lahans->sum('luas_ha');

        // 2. Ambil data batch aktif HANYA di lahan milik user ini
        $batchesAktif = \App\Models\BatchTanam::whereHas('lahan', function($query) use ($userId) {
            $query->where('petani_id', $userId);
        })->with('lahan')->where('status', 'aktif')->orderBy('tanggal_tanam', 'desc')->get();
        
        $totalBatch = $batchesAktif->count(); 

        // 3. Kalkulasi Sisa Hari Panen
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

        // =========================================================
        // ALGORITMA PREDIKSI STOK PANEN (30 HARI KE DEPAN)
        // =========================================================
        $prediksiVolumeKg = 0;
        $detailPrediksi = []; // Array baru untuk menampung rincian ke pop-up
        
        $batchAkanPanen = $batchesAktif->filter(function ($batch) {
            $tglPanen = \Carbon\Carbon::parse($batch->tanggal_tanam)->addDays($batch->durasi_standar_hari);
            $sisaHari = \Carbon\Carbon::now()->diffInDays($tglPanen, false);
            return $sisaHari >= 0 && $sisaHari <= 30;
        });

        if ($batchAkanPanen->count() > 0) {
            foreach ($batchAkanPanen as $batch) {
                $riwayatPanen = \App\Models\HasilPanen::where('hasil_panen.komoditas', $batch->komoditas)
                    ->join('batch_tanam', 'hasil_panen.batch_id', '=', 'batch_tanam.id')
                    ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id') 
                    ->where('lahan.petani_id', $userId)
                    ->select(\Illuminate\Support\Facades\DB::raw('SUM(hasil_panen.jumlah_kg) as total_kg, SUM(lahan.luas_ha) as total_ha'))
                    ->first();

                $rataRataKgPerHa = ($riwayatPanen && $riwayatPanen->total_ha > 0) 
                                    ? ($riwayatPanen->total_kg / $riwayatPanen->total_ha) 
                                    : 6000; 

                $luasLahan = $batch->lahan->luas_ha ?? 0;
                $estimasiBatch = $luasLahan * $rataRataKgPerHa;
                $prediksiVolumeKg += $estimasiBatch;

                // Simpan rincian data untuk ditampilkan di SweetAlert
                $detailPrediksi[] = [
                    'komoditas' => $batch->komoditas,
                    'lahan'     => $batch->lahan->nama_lahan ?? 'Unknown',
                    'luas'      => $luasLahan,
                    'estimasi'  => $estimasiBatch >= 1000 ? number_format($estimasiBatch / 1000, 1) . ' Ton' : number_format($estimasiBatch, 0) . ' Kg'
                ];
            }
        }

        $prediksiStokTeks = $prediksiVolumeKg >= 1000 
            ? number_format($prediksiVolumeKg / 1000, 1) . ' Ton' 
            : number_format($prediksiVolumeKg, 0) . ' Kg';
        // =========================================================

        // 4. Menghitung pendapatan
        $totalPendapatanRaw = 0; 
        
        if ($totalPendapatanRaw >= 1000000000) {
            $pendapatan = round($totalPendapatanRaw / 1000000000, 1) . 'B'; 
        } elseif ($totalPendapatanRaw >= 1000000) {
            $pendapatan = round($totalPendapatanRaw / 1000000, 1) . 'M'; 
        } elseif ($totalPendapatanRaw >= 1000) {
            $pendapatan = round($totalPendapatanRaw / 1000, 1) . 'K'; 
        } else {
            $pendapatan = number_format($totalPendapatanRaw, 0, ',', '.');
        }

        // 5. Ambil jumlah notifikasi
        $jumlahNotif = \App\Models\BatchTanam::countNotifikasiPanen();

        return view('dashboard', compact(
            'lahans', 
            'totalLahan', 
            'totalBatch', 
            'estimasiPanen', 
            'pendapatan',
            'batchesAktif',
            'jumlahNotif',
            'prediksiStokTeks',
            'detailPrediksi'
        )); 
    })->name('dashboard');

    Route::get('/peta-gis', function () {
        $lahans = Lahan::with('petani')->get();
        return view('peta_gis', compact('lahans'));
    })->name('peta.gis');

    // ==========================================================
    // RUTE PROFIL DINAMIS
    // ==========================================================
    Route::get('/profil', function () {
        // Cek jika Admin, panggil file di dalam folder admin/
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.profil');
        }
        // Jika Petani/Distributor, panggil file profil biasa
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
    Route::post('/permintaan/{id}/status', [App\Http\Controllers\NotifikasiController::class, 'updateStatus'])->name('permintaan.update_status');

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
        $lahans = \App\Models\Lahan::with('petani')->get();

        // =========================================================
        // ALGORITMA PREDIKSI SUPLAI PANEN 30 HARI (DISTRIBUTOR)
        // =========================================================
        $prediksiVolumeKg = 0;
        $detailPrediksi = [];

        // 1. Ambil semua batch aktif dari SELURUH petani
        $batchesAktif = \App\Models\BatchTanam::with(['lahan.petani'])->where('status', 'aktif')->get();

        // 2. Filter batch yang akan panen dalam waktu 0 - 30 hari
        $batchAkanPanen = $batchesAktif->filter(function ($batch) {
            $tglPanen = \Carbon\Carbon::parse($batch->tanggal_tanam)->addDays($batch->durasi_standar_hari);
            $sisaHari = \Carbon\Carbon::now()->diffInDays($tglPanen, false);
            return $sisaHari >= 0 && $sisaHari <= 30;
        });

        if ($batchAkanPanen->count() > 0) {
            foreach ($batchAkanPanen as $batch) {
                // 3. Hitung Rata-rata Historis Panen per komoditas secara dinamis
                $riwayatPanen = \App\Models\HasilPanen::where('hasil_panen.komoditas', $batch->komoditas)
                    ->join('batch_tanam', 'hasil_panen.batch_id', '=', 'batch_tanam.id')
                    ->join('lahan', 'batch_tanam.lahan_id', '=', 'lahan.id') 
                    ->select(\Illuminate\Support\Facades\DB::raw('SUM(hasil_panen.jumlah_kg) as total_kg, SUM(lahan.luas_ha) as total_ha'))
                    ->first();

                $rataRataKgPerHa = ($riwayatPanen && $riwayatPanen->total_ha > 0) 
                                    ? ($riwayatPanen->total_kg / $riwayatPanen->total_ha) 
                                    : 6000; 

                // 4. Kalkulasi estimasi dan simpan data untuk pop-up detail
                $luasLahan = $batch->lahan->luas_ha ?? 0;
                $estimasiBatch = $luasLahan * $rataRataKgPerHa;
                $prediksiVolumeKg += $estimasiBatch;

                $detailPrediksi[] = [
                    'petani'    => $batch->lahan->petani->name ?? 'Petani Tidak Diketahui',
                    'komoditas' => $batch->komoditas,
                    'lahan'     => $batch->lahan->nama_lahan ?? 'Unknown',
                    'luas'      => $luasLahan,
                    'estimasi'  => $estimasiBatch >= 1000 ? number_format($estimasiBatch / 1000, 1) . ' Ton' : number_format($estimasiBatch, 0) . ' Kg'
                ];
            }
        }

        $prediksiStokTeks = $prediksiVolumeKg >= 1000 
            ? number_format($prediksiVolumeKg / 1000, 1) . ' Ton' 
            : number_format($prediksiVolumeKg, 0) . ' Kg';
        // =========================================================

        return view('distributor.dashboard', compact('lahans', 'prediksiStokTeks', 'detailPrediksi')); 
    })->name('distributor.dashboard');

    Route::get('/distributor/mitra', function () { 
        $mitras = \App\Models\User::where('role', 'petani')->get();
        
        foreach($mitras as $mitra) {
            $mitra->total_lahan = \App\Models\Lahan::where('petani_id', $mitra->id)->sum('luas_ha');
            
            $komoditas = \App\Models\BatchTanam::whereHas('lahan', function($query) use ($mitra) {
                            $query->where('petani_id', $mitra->id);
                        })
                        ->pluck('komoditas')
                        ->filter()
                        ->unique()
                        ->implode(', ');

            $mitra->list_komoditas = $komoditas ?: 'Bawang Putih Bonggol';
        }

        return view('distributor.mitra', compact('mitras')); 
    })->name('distributor.mitra');

    Route::get('/distributor/pembelian', function () { 
        $permintaans = \App\Models\Permintaan::latest()->get();
        return view('distributor.pembelian', compact('permintaans')); 
    })->name('distributor.pembelian');

    Route::post('/distributor/permintaan', [App\Http\Controllers\DistributorController::class, 'kirimPermintaan'])->name('distributor.permintaan.store');

    Route::post('/distributor/permintaan/{id}/bayar', function ($id) {
        $permintaan = \App\Models\Permintaan::find($id);
        if($permintaan) {
            $permintaan->status = 'lunas';
            $permintaan->save();
        }
        return response()->json(['success' => true]);
    })->name('distributor.permintaan.bayar');

    // ----------------------------------------
    // Admin Routes
    // ----------------------------------------
    Route::prefix('admin')->group(function () {
        Route::get('/pengguna', [\App\Http\Controllers\AdminController::class, 'pengguna'])->name('admin.pengguna');
        Route::post('/pengguna', [\App\Http\Controllers\AdminController::class, 'storePengguna'])->name('admin.pengguna.store');
        Route::put('/pengguna/{id}', [\App\Http\Controllers\AdminController::class, 'updatePengguna'])->name('admin.pengguna.update');
        Route::delete('/pengguna/{id}', [\App\Http\Controllers\AdminController::class, 'destroyPengguna'])->name('admin.pengguna.destroy');
        
        // FIXED: URL diubah menjadi /backup saja karena sudah di dalam prefix 'admin'
        Route::get('/backup', [\App\Http\Controllers\AdminController::class, 'backup'])->name('admin.backup'); 
    });
});