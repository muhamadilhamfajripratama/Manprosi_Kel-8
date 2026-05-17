<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use App\Http\Requests\LahanRequest;

class LahanController extends Controller
{
    public function index()
    {
        $lahans = Lahan::with('petani')->latest()->paginate(10);
        // Ubah view ke 'lahan' dan kirimkan mode 'index'
        return view('lahan', compact('lahans'))->with('mode', 'index');
    }

    public function create()
    {
        // Ubah view ke 'lahan' dan kirimkan mode 'create'
        return view('lahan')->with('mode', 'create');
    }

    public function store(LahanRequest $request)
    {
        $data = $request->validated();
        $data['petani_id'] = auth()->id(); // ambil dari user login

        // FIX: Decode string JSON dari peta menjadi Array agar tidak double-encoding
        if (!empty($data['titik_batas'])) {
            $data['titik_batas'] = json_decode($data['titik_batas'], true);
        }

        Lahan::create($data);

        return redirect()->route('lahan.index')
                         ->with('success', 'Data lahan berhasil ditambahkan.');
    }

    public function show(Lahan $lahan)
    {
        // Ubah view ke 'lahan' dan kirimkan mode 'show'
        return view('lahan', compact('lahan'))->with('mode', 'show');
    }

    public function edit(Lahan $lahan)
    {
        // Ubah view ke 'lahan' dan kirimkan mode 'edit'
        return view('lahan', compact('lahan'))->with('mode', 'edit');
    }

    public function update(LahanRequest $request, Lahan $lahan)
    {
        $data = $request->validated();

        // FIX: Decode string JSON dari peta menjadi Array agar tidak double-encoding
        if (!empty($data['titik_batas'])) {
            $data['titik_batas'] = json_decode($data['titik_batas'], true);
        }

        $lahan->update($data);

        return redirect()->route('lahan.index')
                         ->with('success', 'Data lahan berhasil diperbarui.');
    }

    public function destroy(Lahan $lahan)
    {
        $lahan->delete();

        return redirect()->route('lahan.index')
                         ->with('success', 'Data lahan berhasil dihapus.');
    }
}