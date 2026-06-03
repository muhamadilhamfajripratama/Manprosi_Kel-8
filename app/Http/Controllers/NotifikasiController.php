<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\BatchTanam;
use App\Models\Permintaan; 
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Kunci Notifikasi Panen milik Petani ini
        $batches = BatchTanam::with('lahan')->whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->where('status', 'aktif')->get();
        
        $notifikasi = [];

        foreach ($batches as $batch) {
            $tglTanam = Carbon::parse($batch->tanggal_tanam);
            $tglPanen = $tglTanam->copy()->addDays($batch->durasi_standar_hari);
            $hariIni = Carbon::now();
            
            $selisihHari = (int) $hariIni->diffInDays($tglPanen, false); 

            if ($selisihHari <= 14) {
                $notifikasi[] = (object) [
                    'batch_id'  => $batch->id,
                    'komoditas' => $batch->komoditas,
                    'lahan'     => $batch->lahan->nama_lahan ?? 'Lahan Unknown',
                    'tgl_panen' => $tglPanen->translatedFormat('d F Y'),
                    'selisih'   => $selisihHari,
                    'tipe'      => $selisihHari <= 0 ? 'urgent' : 'warning',
                    'pesan'     => $selisihHari <= 0 
                                   ? "Sudah waktunya panen! Terlewat " . abs($selisihHari) . " hari." 
                                   : "Mendekati masa panen dalam $selisihHari hari ke depan."
                ];
            }
        }

        $notifikasi = collect($notifikasi)->sortBy('selisih')->values();

        // 2. LOGIKA PERMINTAAN DISTRIBUTOR
        $permintaanDistributor = collect(); 

        if (Auth::check()) {
            $userName = Auth::user()->name; 
            $namaDepan = explode(' ', trim($userName))[0]; 
            
            $permintaanDistributor = Permintaan::where('status', 'menunggu')
                ->where(function($query) use ($namaDepan) {
                    $query->where('target_petani', 'LIKE', '%' . $namaDepan . '%')
                          ->orWhere('target_petani', 'all');
                })
                ->latest() 
                ->get();
        }

        return view('notifikasi', compact('notifikasi', 'permintaanDistributor'));
    }

    public function updateStatus(Request $request, $id)
    {
        $permintaan = Permintaan::findOrFail($id);
        
        $permintaan->status = $request->status; 
        $permintaan->save();

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diubah menjadi ' . $request->status
        ]);
    }
}