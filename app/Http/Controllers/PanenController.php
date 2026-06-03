<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\HasilPanen;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PanenController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $batches = \App\Models\BatchTanam::with('lahan')->whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->whereIn('status', ['aktif', 'selesai'])->get();
        
        $riwayats = \App\Models\HasilPanen::with('batchTanam')->whereHas('batchTanam.lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->orderBy('tanggal_panen', 'desc')->get();

        return view('panen', compact('batches', 'riwayats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'      => 'required',
            'tanggal_panen' => 'required|date',
            'jumlah_kg'     => 'required|numeric|min:1',
            'kualitas'      => 'required|in:Grade A,Grade B,Grade C',
        ]);

        $batch = BatchTanam::findOrFail($request->batch_id);
        
        $tglTanam = Carbon::parse($batch->tanggal_tanam)->startOfDay();
        $tglPanen = Carbon::parse($request->tanggal_panen)->startOfDay();
        $umurAktual = $tglTanam->diffInDays($tglPanen, false);
        
        if ($umurAktual < $batch->durasi_standar_hari) {
            $kurang = $batch->durasi_standar_hari - $umurAktual;
            return redirect()->back()->with('error', "Validasi Gagal! Tanaman belum cukup umur. Masih kurang $kurang hari lagi.");
        }

        HasilPanen::create([
            'batch_id'        => $request->batch_id,
            'tanggal_panen'   => $request->tanggal_panen,
            'jumlah_kg'       => $request->jumlah_kg,
            'komoditas'       => $batch->komoditas,
            'kualitas'        => $request->kualitas,
            'umur_panen_hari' => $umurAktual,
            'catatan'         => $request->catatan,
        ]);

        $batch->update(['status' => 'selesai']);
        return redirect()->back()->with('success', 'Hasil panen berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'      => 'required',
            'tanggal_panen' => 'required|date',
            'jumlah_kg'     => 'required|numeric|min:1',
            'kualitas'      => 'required|in:Grade A,Grade B,Grade C',
        ]);

        $panen = HasilPanen::findOrFail($id);
        $batch = BatchTanam::findOrFail($request->batch_id);
        
        $tglTanam = Carbon::parse($batch->tanggal_tanam)->startOfDay();
        $tglPanen = Carbon::parse($request->tanggal_panen)->startOfDay();
        $umurAktual = $tglTanam->diffInDays($tglPanen, false);
        
        if ($umurAktual < $batch->durasi_standar_hari) {
            $kurang = $batch->durasi_standar_hari - $umurAktual;
            return redirect()->back()->with('error', "Validasi Gagal! Perubahan tanggal membuat umur kurang $kurang hari dari standar.");
        }

        if ($panen->batch_id != $request->batch_id) {
            BatchTanam::where('id', $panen->batch_id)->update(['status' => 'aktif']);
        }

        $panen->update([
            'batch_id'        => $request->batch_id,
            'tanggal_panen'   => $request->tanggal_panen,
            'jumlah_kg'       => $request->jumlah_kg,
            'komoditas'       => $batch->komoditas,
            'kualitas'        => $request->kualitas,
            'umur_panen_hari' => $umurAktual,
            'catatan'         => $request->catatan,
        ]);

        $batch->update(['status' => 'selesai']);
        return redirect()->back()->with('success', 'Data hasil panen berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $panen = HasilPanen::findOrFail($id);
            BatchTanam::where('id', $panen->batch_id)->update(['status' => 'aktif']);
            $panen->delete();
            return redirect()->back()->with('success', 'Data hasil panen berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data hasil panen.');
        }
    }
}