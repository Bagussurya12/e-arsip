<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use App\Models\Procurement;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DokumentasiController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $procurement_id = (int) $request->procurement_id; // Cast to integer
        return Inertia::render('Procurement/Dokumentasi/Create', [
            'procurement_id' => $id,

        ]);
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
        // dd($request->all());
        $validated = $request->validate([
            'procurement_id' => 'exists:procurements,id',
            'title' => 'string|max:255',
            'tanggal' => 'date',
            'deskripsi' => 'string',
            'foto' => 'file|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Menyimpan file foto jika ada
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dokumentasi-foto');
        }

        // Tambahkan user_id ke data yang tervalidasi
        $validated['user_id'] = auth()->user()->id;

        // Buat dokumentasi baru
         Dokumentasi::create($validated);
        return redirect()->route('procurement.details', ['procurementId' => $validated['procurement_id']])
        ->with('success', 'Dokumentasi berhasil disimpan!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokumentasi = Dokumentasi::find($id);
        return Inertia::render('Procurement/Dokumentasi/Edit', [
            'dokumentasi' => $dokumentasi
        ]);
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
            'title' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Jika ada file foto yang diunggah, simpan file baru dan hapus file lama
        if ($request->hasFile('foto')) {
            if ($dokumentasi->foto) {
                Storage::delete($dokumentasi->foto); // Hapus file lama
            }
            $validated['foto'] = $request->file('foto')->store('dokumentasi-foto');
        }else{
            $validated['foto'] = $dokumentasi -> foto;
        }
        $validated['user_id'] = auth()->user()->id;

        $procurement_id = $dokumentasi -> procurement_id;
        // Update data dokumentasi
        $dokumentasi->update($validated);
        return redirect()->route('procurement.details', ['procurementId' => $procurement_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dokumentasi  $dokumentasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dokumentasi = Dokumentasi::findOrFail($id);
        // Hapus foto jika ada
        if ($dokumentasi->foto) {
            Storage::delete($dokumentasi->foto);
        }
        $procurementId = $dokumentasi -> procurement_id;
        // Hapus data dokumentasi
        $dokumentasi->delete();

        return redirect()->route('procurement.details', ['procurementId' => $procurementId]);
    }
// app/Http/Controllers/DokumentasiController.php
    public function detail($id)
    {
        $dokumentasi = Dokumentasi::with('user')->findOrFail($id);
        return Inertia::render('Procurement/Dokumentasi/Detail', [
                'dokumentasi' => $dokumentasi,
                'user_name' => $dokumentasi->user->name  // Pastikan 'name' adalah kolom di tabel users
        ]);
    }
}
