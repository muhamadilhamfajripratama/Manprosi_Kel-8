<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanPemupukan;
use App\Models\KegiatanHama;
use App\Models\KegiatanIrigasi;
use App\Models\KegiatanPerawatan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
public function index()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();
        $events = [];

        // TRIK AMAN: Ambil kumpulan ID Batch yang sah milik petani ini
        $validBatchIds = \App\Models\BatchTanam::whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->pluck('id');

        // 1. Jadwal Pemupukan 
        $pemupukan = \App\Models\KegiatanPemupukan::whereIn('batch_id', $validBatchIds)->get();
        foreach ($pemupukan as $item) {
            $events[] = [
                'title' => 'Pemupukan ' . ($item->jenis_pupuk ?? ''),
                'start' => $item->tanggal,
                'color' => '#43B75D', 
                'url'   => url('/penanaman/detail/' . $item->batch_id)
            ];
        }

        // 2. Jadwal Cek Hama
        $hama = \App\Models\KegiatanHama::whereIn('batch_id', $validBatchIds)->get();
        foreach ($hama as $item) {
            $events[] = [
                'title' => 'Cek Hama: ' . ($item->jenis_hama ?? ''),
                'start' => $item->tanggal,
                'color' => '#EF4444', 
                'url'   => url('/penanaman/detail/' . $item->batch_id)
            ];
        }

        // 3. Jadwal Irigasi
        $irigasi = \App\Models\KegiatanIrigasi::whereIn('batch_id', $validBatchIds)->get();
        foreach ($irigasi as $item) {
            $events[] = [
                'title' => 'Irigasi Air',
                'start' => $item->tanggal,
                'color' => '#3B82F6', 
                'url'   => url('/penanaman/detail/' . $item->batch_id)
            ];
        }

        // 4. Estimasi Panen Batch Aktif
        $batches = \App\Models\BatchTanam::whereIn('id', $validBatchIds)->where('status', 'aktif')->get();
        foreach ($batches as $batch) {
            $tglTanam = \Carbon\Carbon::parse($batch->tanggal_tanam);
            $tglPanen = $tglTanam->addDays($batch->durasi_standar_hari ?: 1)->format('Y-m-d');
            
            $events[] = [
                'title' => 'Est. Panen: ' . $batch->komoditas,
                'start' => $tglPanen,
                'color' => '#F59E0B', 
                'url'   => url('/penanaman/detail/' . $batch->id)
            ];
        }

        return view('jadwal', compact('events'));
    }
}