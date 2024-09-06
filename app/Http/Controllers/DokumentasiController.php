<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Procurement;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Mengambil semua dokumentasi
        $dokumentasi = Dokumentasi::with('procurement', 'user')->get();

        return view('dokumentasi.index', compact('dokumentasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil data procurement untuk digunakan di form
        $procurements = Procurement::all();

        return view('dokumentasi.create', compact('procurements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'procurement_id' => 'required|exists:procurements,id',
            'title' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Menyimpan file foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dokumentasi-foto');
        }

        // Tambahkan user_id ke data yang tervalidasi
        $validated['user_id'] = auth()->user()->id;

        // Buat dokumentasi baru
        Dokumentasi::create($validated);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumentasi $dokumentasi)
    {
        // Ambil data procurement untuk digunakan di form
        $procurements = Procurement::all();

        return view('dokumentasi.edit', compact('dokumentasi', 'procurements'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        // Validasi input
        $validated = $request->validate([
            'procurement_id' => 'required|exists:procurements,id',
            'title' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Jika ada file foto yang diunggah, simpan file baru dan hapus file lama
        if ($request->hasFile('foto')) {
            if ($dokumentasi->foto) {
                \Storage::delete($dokumentasi->foto); // Hapus file lama
            }
            $validated['foto'] = $request->file('foto')->store('dokumentasi-foto');
        }

        // Update data dokumentasi
        $dokumentasi->update($validated);

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumentasi $dokumentasi)
    {
        // Hapus foto jika ada
        if ($dokumentasi->foto) {
            \Storage::delete($dokumentasi->foto);
        }

        // Hapus data dokumentasi
        $dokumentasi->delete();

        return redirect()->route('dokumentasi.index')->with('success', 'Dokumentasi berhasil dihapus.');
    }
}
