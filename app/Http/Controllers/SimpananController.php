<?php

namespace App\Http\Controllers;

use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index()
    {
        $simpanans = Simpanan::with('anggota')->latest()->get();

        return view('simpanan.index', compact('simpanans'));
    }

    public function create()
    {
        $anggotas = Anggota::all();

        return view('simpanan.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal' => 'required|date',
            'jenis_simpanan' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        Simpanan::create($request->only([
            'anggota_id',
            'tanggal',
            'jenis_simpanan',
            'jumlah',
            'keterangan',
        ]));

        return redirect()->route('simpanan.index')
            ->with('success', 'Simpanan berhasil ditambahkan.');
    }

    public function show(Simpanan $simpanan)
    {
        return view('simpanan.show', compact('simpanan'));
    }

    public function edit(Simpanan $simpanan)
    {
        $anggotas = Anggota::all();

        return view('simpanan.edit', compact('simpanan', 'anggotas'));
    }

    public function update(Request $request, Simpanan $simpanan)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal' => 'required|date',
            'jenis_simpanan' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
        ]);

        $simpanan->update($request->only([
            'anggota_id',
            'tanggal',
            'jenis_simpanan',
            'jumlah',
            'keterangan',
        ]));

        return redirect()->route('simpanan.index')
            ->with('success', 'Simpanan berhasil diubah.');
    }

    public function destroy(Simpanan $simpanan)
    {
        Simpanan::destroy($simpanan->id);

        return redirect()->route('simpanan.index')
            ->with('success', 'Simpanan berhasil dihapus.');
    }
}