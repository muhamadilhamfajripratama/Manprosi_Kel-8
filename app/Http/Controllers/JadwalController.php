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
        $events = [];

        // 1. Ambil Jadwal Pemupukan (Warna Hijau)
        $pemupukan = KegiatanPemupukan::all();
        foreach ($pemupukan as $item) {
            $events[] = [
                'title' => 'Pemupukan ' . ($item->jenis_pupuk ?? ''),
                'start' => $item->tanggal,
                'color' => '#43B75D', // Hijau
                'url'   => url('/penanaman/detail/' . $item->batch_id)
            ];
        }

        // 2. Ambil Jadwal Cek Hama (Warna Merah)
        $hama = KegiatanHama::all();
        foreach ($hama as $item) {
            $events[] = [
                'title' => 'Cek Hama: ' . ($item->jenis_hama ?? ''),
                'start' => $item->tanggal,
                'color' => '#EF4444', // Merah
                'url'   => url('/penanaman/detail/' . $item->batch_id)
            ];
        }

        // 3. Ambil Jadwal Irigasi (Warna Biru)
        $irigasi = KegiatanIrigasi::all();
        foreach ($irigasi as $item) {
            $events[] = [
                'title' => 'Irigasi Air',
                'start' => $item->tanggal,
                'color' => '#3B82F6', // Biru
                'url'   => url('/penanaman/detail/' . $item->batch_id)
            ];
        }

        // 4. Hitung Estimasi Panen dari Batch Aktif (Warna Orange)
        $batches = BatchTanam::where('status', 'aktif')->get();
        foreach ($batches as $batch) {
            $tglTanam = Carbon::parse($batch->tanggal_tanam);
            $tglPanen = $tglTanam->addDays($batch->durasi_standar_hari ?: 1)->format('Y-m-d');
            
            $events[] = [
                'title' => 'Est. Panen: ' . $batch->komoditas,
                'start' => $tglPanen,
                'color' => '#F59E0B', // Orange
                'url'   => url('/penanaman/detail/' . $batch->id)
            ];
        }

        return view('jadwal', compact('events'));
    }
}