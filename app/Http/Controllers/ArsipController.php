<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Arsip;
use App\Models\LokasiSimpan;

class ArsipController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_arsip' => 'string',
            'uraian_informasi' => 'string',
            'tanggal_surat' => 'date',
            'nomor_urut_perbulan' => 'integer',
            'nomor_dokumen' => 'string',
            'jumlah' => 'integer',
            'asal_surat' => 'string',
            'tingkat_perkembangan' => 'string',
            'keterangan' => 'in:Surat Masuk,Surat Keluar',
            'lemari' => 'integer',
            'no_bindeks' => 'integer',
            'map_bulan' => 'string',
            'jenis_media' => 'string',
            'media' => 'file|mimes:jpg,png,jpeg,pdf,mp4,mp3',
        ]);

        if ($request->file('media')) {
            $validated['media'] = $request->file('media')->store('assets-arsip');
        }

        $arsip = Arsip::create($validated);

        $lokasi_simpan = LokasiSimpan::create([
            'arsip_id' => $arsip->id,
            'kolom_lemari' => $request->kolom_lemari,
            'no_bindeks' => $request->no_bindeks,
            'map_bulan' => $request->map_bulan,
        ]);

        return redirect()->route('arsip');
    }

    public function index(Request $request)
    {
        $arsip = Arsip::with('lokasiSimpan')->paginate(20);
        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip
        ]);
    }

    public function create()
    {
        return Inertia::render('Arsip/Create');
    }

    public function edit($id)
    {
        $arsip = Arsip::with('lokasiSimpan')->findOrFail($id);
        return Inertia::render('Arsip/Edit', [
            'arsip' => $arsip
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jenis_arsip' => 'string',
            'uraian_informasi' => 'string',
            'tanggal_surat' => 'date',
            'nomor_urut_perbulan' => 'integer',
            'nomor_dokumen' => 'string',
            'jumlah' => 'integer',
            'asal_surat' => 'string',
            'tingkat_perkembangan' => 'string',
            'keterangan' => 'in:Surat Masuk,Surat Keluar',
            'lemari' => 'integer',
            'no_bindeks' => 'integer',
            'map_bulan' => 'string',
            'jenis_media' => 'string',
            'media' => 'file|mimes:jpg,png,jpeg,pdf,mp4,mp3',
        ]);
    
        $arsip = Arsip::findOrFail($id);
    
        if ($request->file('media')) {
            $validated['media'] = $request->file('media')->store('assets-arsip');
        }
    
        $arsip->update($validated);
    
        if ($arsip->lokasiSimpan) {
            $arsip->lokasiSimpan->update([
                'kolom_lemari' => $request->lemari,
                'no_bindeks' => $request->no_bindeks,
                'map_bulan' => $request->map_bulan,
            ]);
        } else {
            LokasiSimpan::create([
                'arsip_id' => $arsip->id,
                'kolom_lemari' => $request->lemari,
                'no_bindeks' => $request->no_bindeks,
                'map_bulan' => $request->map_bulan,
            ]);
        }
    
        return redirect()->route('arsip')->with('success', 'Data arsip berhasil diperbarui');
    }
}
