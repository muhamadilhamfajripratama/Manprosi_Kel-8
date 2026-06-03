<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BatchTanam;
use App\Models\KegiatanIrigasi;
use Illuminate\Support\Facades\Auth;

class IrigasiController extends Controller
{
public function index()
    {
        $userId = \Illuminate\Support\Facades\Auth::id();

        $validBatchIds = \App\Models\BatchTanam::whereHas('lahan', function($q) use ($userId) {
            $q->where('petani_id', $userId);
        })->pluck('id');

        $batches = \App\Models\BatchTanam::with('lahan')->whereIn('id', $validBatchIds)->where('status', 'aktif')->get(); 
        
        $riwayats = \App\Models\KegiatanIrigasi::whereIn('batch_id', $validBatchIds)->orderBy('tanggal', 'desc')->get();

        $totalDebit = $riwayats->sum('debit_liter');
        $totalIrigasi = $riwayats->count(); 

        return view('irigasi', compact('batches', 'riwayats', 'totalDebit', 'totalIrigasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'batch_id'         => 'required',
            'tanggal'          => 'required|date',
            'debit_liter'      => 'required|numeric',
            'sumber_pengairan' => 'nullable|string', 
        ]);

        KegiatanIrigasi::create([
            'batch_id'         => $request->batch_id,
            'tanggal'          => $request->tanggal,
            'debit_liter'      => $request->debit_liter,
            'sumber_pengairan' => $request->sumber_pengairan,
            'catatan'          => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data irigasi berhasil dicatat!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'batch_id'         => 'required',
            'tanggal'          => 'required|date',
            'debit_liter'      => 'required|numeric',
            'sumber_pengairan' => 'required|string',
        ]);

        $irigasi = \App\Models\KegiatanIrigasi::findOrFail($id);
        
        $irigasi->update([
            'batch_id'         => $request->batch_id,
            'tanggal'          => $request->tanggal,
            'debit_liter'      => $request->debit_liter,
            'sumber_pengairan' => $request->sumber_pengairan,
            'catatan'          => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Data pengairan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        try {
            $irigasi = \App\Models\KegiatanIrigasi::findOrFail($id);
            $irigasi->delete();
            return redirect()->back()->with('success', 'Data pengairan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data pengairan.');
        }
    }
}