<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\Lahan;
use Illuminate\Support\Facades\Auth;

class PenanamanController extends Controller
{
    public function index()
    {
        // Ambil data batch beserta relasi lahannya
        $batches = BatchTanam::with('lahan')->orderBy('created_at', 'desc')->get();
        
        // Ambil data lahan milik petani yang sedang login untuk pilihan di modal
        $lahans = Lahan::where('petani_id', Auth::id())->get(); 

        return view('penanaman', compact('batches', 'lahans'));
    }

    public function store(Request $request)
    {
        // Simpan data batch baru sesuai skema migration
        BatchTanam::create([
            'lahan_id'            => $request->lahan_id,
            'petani_id'           => Auth::id(), // Otomatis terisi ID petani yang login
            'komoditas'           => $request->komoditas,
            'tanggal_tanam'       => $request->tanggal_tanam,
            'asal_bibit'          => $request->asal_bibit,
            'jumlah_bibit'        => $request->jumlah_bibit,
            'satuan_bibit'        => $request->satuan_bibit,
            'jarak_tanam_cm'      => $request->jarak_tanam_cm,
            'metode_tanam'        => $request->metode_tanam,
            'durasi_standar_hari' => $request->durasi_standar_hari,
            'catatan'             => $request->catatan,
            'status'              => 'aktif', // Status default
        ]);

        return redirect()->back()->with('success', 'Proses penanaman baru berhasil dimulai!');
    }
}