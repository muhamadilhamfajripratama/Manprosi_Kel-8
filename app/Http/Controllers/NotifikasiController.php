<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil semua batch yang masih aktif
        $batches = BatchTanam::with('lahan')->where('status', 'aktif')->get();
        $notifikasi = [];

        foreach ($batches as $batch) {
            // Kalkulasi tanggal panen
            $tglTanam = Carbon::parse($batch->tanggal_tanam);
            $tglPanen = $tglTanam->copy()->addDays($batch->durasi_standar_hari);
            $hariIni = Carbon::now();
            
            // Hitung sisa hari (false agar bisa mendeteksi minus/lewat batas)
            $selisihHari = $hariIni->diffInDays($tglPanen, false); 

            // Jika kurang dari atau sama dengan 14 hari, masukkan ke daftar notifikasi
            if ($selisihHari <= 14) {
                $notifikasi[] = (object) [
                    'batch_id'  => $batch->id,
                    'komoditas' => $batch->komoditas,
                    'lahan'     => $batch->lahan->nama_lahan ?? 'Lahan Unknown',
                    'tgl_panen' => $tglPanen->translatedFormat('d F Y'),
                    'selisih'   => $selisihHari,
                    // Tentukan level bahaya/urgensi
                    'tipe'      => $selisihHari <= 0 ? 'urgent' : 'warning',
                    'pesan'     => $selisihHari <= 0 
                                   ? "Sudah waktunya panen! Terlewat " . abs($selisihHari) . " hari." 
                                   : "Mendekati masa panen dalam $selisihHari hari ke depan."
                ];
            }
        }

        // Ubah jadi collection lalu urutkan dari yang paling darurat (selisih terkecil)
        $notifikasi = collect($notifikasi)->sortBy('selisih')->values();

        return view('notifikasi', compact('notifikasi'));
    }
}