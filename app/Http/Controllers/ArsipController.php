<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Models\LokasiSimpan;
use App\Models\MediaArsip;

class ArsipController extends Controller
{
    // Menyimpan arsip beserta lokasi simpan dan media arsip
    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'jenis_arsip' => 'required|string',
            'uraian_informasi' => 'required|string',
            'asal_surat' => 'required|string',
            'tanggal_surat' => 'required|date',
            'nomor_urut_perbulan' => 'required|integer',
            'nomor_dokumen' => 'required|string',
            'jumlah' => 'nullable|integer',
            'tingkat_perkembangan' => 'required|string',
            'keterangan' => 'required|in:Surat Masuk,Surat Keluar',
            'lemari' => 'required|integer',
            'no_bindeks' => 'required|integer',
            'map_bulan' => 'nullable|string',
            'jenis_media' => 'required|in:Gambar,PDF,Video,Audio',
            'nama_media' => 'required|string',
        ]);

        // Simpan data arsip
        $arsip = Arsip::create([
            'jenis_arsip' => $request->jenis_arsip,
            'uraian_informasi' => $request->uraian_informasi,
            'asal_surat' => $request->asal_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'nomor_urut_perbulan' => $request->nomor_urut_perbulan,
            'nomor_dokumen' => $request->nomor_dokumen,
            'jumlah' => $request->jumlah,
            'tingkat_perkembangan' => $request->tingkat_perkembangan,
            'keterangan' => $request->keterangan,
        ]);

        // Simpan data lokasi simpan
        $lokasiSimpan = LokasiSimpan::create([
            'arsip_id' => $arsip->id,
            'lemari' => $request->lemari,
            'no_bindeks' => $request->no_bindeks,
            'map_bulan' => $request->map_bulan,
        ]);

        // Simpan data media arsip
        $mediaArsip = MediaArsip::create([
            'arsip_id' => $arsip->id,
            'jenis_media' => $request->jenis_media,
            'nama_media' => $request->nama_media,
        ]);

        return response()->json(['message' => 'Arsip berhasil disimpan'], 201);
    }

    // Mengambil data arsip beserta lokasi simpan dan media arsip
    public function show($id)
    {
        $arsip = Arsip::with('lokasiSimpan', 'mediaArsip')->findOrFail($id);

        return response()->json($arsip);
    }
}