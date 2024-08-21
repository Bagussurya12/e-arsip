<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaDinas;
use App\Models\Arsip;
use Inertia\Inertia;

class NotaDinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $arsip = Arsip::find($id); // Menggunakan '::' untuk metode statis
        // Anda tidak perlu `dd($id)` jika Anda ingin melanjutkan eksekusi
        return Inertia::render('NotaDinas/Create', [
            'arsip' => $arsip,
            'arsip_id' => $arsip->id,  // Arsip ID yang diteruskan ke frontend
            'nomor_dokumen' => $arsip->nomor_dokumen,  // Nomor dokumen yang diteruskan ke frontend
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
         $validated = $request->validate([
                'arsip_id' => 'required|exists:arsip,id',  // Pastikan arsip_id valid
                'nomor_dokumen'=> 'nullable|string|max:255',
                'tanggal'=> 'nullable|date|max:255',
                'perihal'=> 'nullable|string|max:255',
                'kepada'=> 'nullable|string|max:255',
                'dari'=> 'nullable|string|max:255',
                'isi'=> 'nullable|string|max:255',
                'tembusan'=> 'nullable|string|max:255',
                'foto' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3|max:2048',
        ]);

    if ($request->hasFile('foto')) {
        $validated['foto'] = $request->file('foto')->store('assets_Arsip_NotaDinas', 'public');
    }

    $nota_dinas = NotaDinas::create($validated);

    return redirect()->route('arsip')->with('success', 'Data Nota Dinas berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
