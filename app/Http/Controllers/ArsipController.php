<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Arsip;
use App\Models\LokasiSimpan;
use App\Models\Undangan;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'string|in:Surat Masuk,Surat Keluar',
            'jenis_surat' => 'string',
            'asal_surat' => 'string',
            'tanggal' => 'integer',
            'bulan' => 'string',
            'tahun' => 'integer',
            'uraian_informasi' => 'string',
            'nomor_urut_perbulan' => 'integer',
            'nomor_dokumen' => 'string',
            'jumlah' => 'integer',
            'tingkat_perkembangan' => 'string',
            'disposisi' => 'nullable|string',
            'terusan' => 'nullable|string',
            'kolom_lemari' => 'integer',
            'kotak' => 'string',
            'jenis_media' => 'string',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3',
            'disposisi_acara' => 'nullable|string|max:255',
            'notulen' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'foto_kegiatan' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3|max:2048',
        ]);
    
        // Menyimpan media jika ada
        if ($request->file('media')) {
            $validated['media'] = $request->file('media')->store('assets-arsip');
        }
    
        $arsip = Arsip::create($validated);
    
        $jenis_surat = $request->input('jenis_surat');
    
        // Menangani surat undangan secara terpisah
        if ($jenis_surat === 'Surat Undangan') {
            $undangan = new Undangan();
            $undangan->arsip_id = $arsip->id;
            $undangan->disposisi_acara = $request->input('disposisi_acara');
            $undangan->notulen = $request->input('notulen');
            $undangan->keterangan_undangan = $request->input('keterangan_undangan'); // Pastikan field sesuai dengan model Undangan
            if ($request->file('foto_kegiatan')) {
                $undangan->foto_kegiatan = $request->file('foto_kegiatan')->store('assets_ArsipUndangan');
            }
            $undangan->save();
        }
    
        LokasiSimpan::create([
            'arsip_id' => $arsip->id,
            'kolom_lemari' => $request->kolom_lemari,
            'kotak' => $request->kotak
        ]);
    
        return redirect()->route('arsip')->with('success', 'Arsip berhasil ditambahkan.');
    }
    
    public function index(Request $request)
    {
        $query = Arsip::with('lokasiSimpan');

        if ($request->has('naskahDinas')) {
            $query->where('jenis_arsip', 'like', '%' . $request->input('naskahDinas') . '%');
        }

        if ($request->has('searchQuery')) {
            $query->where('uraian_informasi', 'like', '%' . $request->input('searchQuery') . '%');
        }

        if ($request->has('filterBulan')) {
            $query->where('map_bulan', 'like', '%' . $request->input('filterBulan') . '%');
        }

        if ($request->has('filterTahun')) {
            $query->where('tahun', $request->input('filterTahun'));
        }

        if ($request->has('filterMediaArsip')) {
            $query->where('jenis_media', 'like', '%' . $request->input('filterMediaArsip') . '%');
        }

        $arsip = $query->paginate(20);

        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip
        ]);
    }

    public function getDataArsip(Request $request)
    {
        $query = Arsip::with('lokasiSimpan');

        if ($request->has('naskahDinas')) {
            $query->where('jenis_arsip', 'like', '%' . $request->input('naskahDinas') . '%');
        }

        if ($request->has('searchQuery')) {
            $query->where('uraian_informasi', 'like', '%' . $request->input('searchQuery') . '%');
        }

        if ($request->has('filterBulan')) {
            $query->where('map_bulan', 'like', '%' . $request->input('filterBulan') . '%');
        }

        if ($request->has('filterTahun')) {
            $query->where('tahun', $request->input('filterTahun'));
        }

        if ($request->has('filterMediaArsip')) {
            $query->where('jenis_media', 'like', '%' . $request->input('filterMediaArsip') . '%');
        }

        $arsip = $query->paginate(9);

        return Inertia::render('Welcome', [
            'arsip' => $arsip
        ]);
    }

    public function detail($id)
    {
        $arsip = Arsip::with('lokasiSimpan')->find($id);

        return Inertia::render('detail', [
            'arsip' => $arsip
        ]);
    }

    public function create()
    {
        return Inertia::render('Arsip/Create');
    }

    public function edit($id)
    {
        $arsip = Arsip::with('lokasiSimpan')->find($id);
        return Inertia::render('Arsip/Edit', [
            'arsip' => $arsip
        ]);
    }
    public function undangan_detail($id)
    {
        $arsip = Arsip::with('lokasiSimpan', 'undangan')->find($id);
        return Inertia::render('Arsip/Detail', [
            'arsip' => $arsip
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'keterangan' => 'required|string|in:Surat Masuk,Surat Keluar',
            'jenis_surat' => 'required|string',
            'asal_surat' => 'required|string',
            'tanggal' => 'required|integer',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'uraian_informasi' => 'required|string',
            'nomor_urut_perbulan' => 'required|integer',
            'nomor_dokumen' => 'required|string',
            'jumlah' => 'required|integer',
            'tingkat_perkembangan' => 'required|string',
            'disposisi' => 'required|string',
            'terusan' => 'required|string',
            'kolom_lemari' => 'required|integer',
            'kotak' => 'required|string',
            'jenis_media' => 'required|string',
            'media' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3',
        ]);

        $arsip = Arsip::findOrFail($id);

        if ($request->hasFile('media')) {
            if ($arsip->media) {
                Storage::delete($arsip->media);
            }
            $validated['media'] = $request->file('media')->store('assets-arsip');
        } else {
            $validated['media'] = $arsip->media;
        }

        $arsip->update($validated);

        if ($arsip->lokasiSimpan) {
            $arsip->lokasiSimpan->update([
                'kolom_lemari' => $request->kolom_lemari,
                'kotak' => $request->kotak,
            ]);
        } else {
            LokasiSimpan::create([
                'arsip_id' => $arsip->id,
                'kolom_lemari' => $request->kolom_lemari,
                'kotak' => $request->kotak,
            ]);
        }

        return redirect()->route('arsip')->with('success', 'Data arsip berhasil diperbarui');
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($arsip->media) {
            Storage::delete($arsip->media);
        }

        $arsip->delete();

        return redirect(route('arsip'))->with('success', 'Data arsip berhasil dihapus');
    }
}
