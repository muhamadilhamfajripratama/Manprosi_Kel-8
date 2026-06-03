<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Http\Requests\LahanRequest;
use Illuminate\Support\Facades\Auth;

class LahanController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // TAMBAHKAN INISIALISASI INI
        $lahans = Lahan::with('petani')->where('petani_id', $userId)->get();
        
        return view('lahan', compact('lahans'))->with('mode', 'index');
    }

    public function create()
    {
        return view('lahan')->with('mode', 'create');
    }

    public function store(LahanRequest $request)
    {
        $data = $request->validated();
        $data['petani_id'] = auth()->id(); 

        if (!empty($data['titik_batas'])) {
            $data['titik_batas'] = json_decode($data['titik_batas'], true);
        }

        Lahan::create($data);

        return redirect()->route('lahan.index')->with('success', 'Data lahan berhasil ditambahkan.');
    }

    public function show(Lahan $lahan)
    {
        return view('lahan', compact('lahan'))->with('mode', 'show');
    }

    public function edit(Lahan $lahan)
    {
        return view('lahan', compact('lahan'))->with('mode', 'edit');
    }

    public function update(LahanRequest $request, Lahan $lahan)
    {
        $data = $request->validated();

        if (!empty($data['titik_batas'])) {
            $data['titik_batas'] = json_decode($data['titik_batas'], true);
        }

        $lahan->update($data);

        return redirect()->route('lahan.index')->with('success', 'Data lahan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $lahan = \App\Models\Lahan::findOrFail($id);
            $lahan->delete();
            return redirect()->route('lahan.index')->with('success', 'Data lahan berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('lahan.index')->with('error', 'Gagal menghapus! Lahan ini masih memiliki riwayat tanam yang terhubung.');
        } catch (\Exception $e) {
            return redirect()->route('lahan.index')->with('error', 'Terjadi kesalahan saat menghapus lahan.');
        }
    }
}