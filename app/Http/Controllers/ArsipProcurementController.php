<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use App\Models\Arsip;
use App\Models\LokasiSimpan;
use App\Models\NotaDinas;
use App\Models\Undangan;
use App\Models\Terusan;
use App\Models\Procurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArsipProcurementController extends Controller
{
    public function create(Request $request)
    {
        $procurement_id = (int) $request->procurement_id; // Cast to integer
        $terusan = Terusan::all();
        return inertia('Procurement/Surat/Create', [
            'procurement_id' => $procurement_id,
            'terusan' => $terusan,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'procurement_id' => 'integer|exists:procurements,id',
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

        $validated['user_id'] = auth()->user()->id;

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
                $undangan->foto_kegiatan = $request->file('foto_kegiatan')->store('assets-arsip');
            }
            $undangan->save();
        }

        LokasiSimpan::create([
            'arsip_id' => $arsip->id,
            'kolom_lemari' => $request->kolom_lemari,
            'kotak' => $request->kotak
        ]);

        return redirect()->route('procurement.details', [
            'procurementId' => $validated['procurement_id']
        ]);
    }

    public function edit($id)
    {
        $arsip = Arsip::with('lokasiSimpan', 'undangan')->find($id);
        $terusan = Terusan::all();
        return Inertia::render('Procurement/Surat/Edit', [
            'arsip' => $arsip,
            'terusan' => $terusan
        ]);
    }
    public function arsip_detail($id)
    {
        $arsip = Arsip::with('lokasiSimpan', 'undangan', 'notaDinas')->find($id);
        return Inertia::render('Arsip/Detail', [
            'arsip' => $arsip
        ]);
    }
    public function update(Request $request, Procurement $procurement, $id)
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
            'keterangan_undangan' => 'nullable|string|max:255',
            'foto_kegiatan' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3|max:2048',
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

        $validated['user_id'] = auth()->user()->id;

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

        // Menangani update undangan jika arsip adalah Surat Undangan
        if ($arsip->jenis_surat === 'Surat Undangan') {
            $undangan = Undangan::where('arsip_id', $arsip->id)->first();
            if ($undangan) {
                $undangan->disposisi_acara = $request->input('disposisi_acara');
                $undangan->notulen = $request->input('notulen');
                $undangan->keterangan_undangan = $request->input('keterangan_undangan');
                if ($request->hasFile('foto_kegiatan')) {
                    if ($undangan->foto_kegiatan) {
                        Storage::delete($undangan->foto_kegiatan);
                    }
                    $undangan->foto_kegiatan = $request->file('foto_kegiatan')->store('assets-arsip');
                }
                $undangan->save();
            } else {
                $undangan = new Undangan();
                $undangan->arsip_id = $arsip->id;
                $undangan->disposisi_acara = $request->input('disposisi_acara');
                $undangan->notulen = $request->input('notulen');
                $undangan->keterangan_undangan = $request->input('keterangan_undangan');
                if ($request->file('foto_kegiatan')) {
                    $undangan->foto_kegiatan = $request->file('foto_kegiatan')->store('assets-arsip');
                }
                $undangan->save();
            }
        }


            $procurement_id = $arsip-> procurement_id;
            return redirect()->route('procurement.details', ['procurementId' => $procurement_id]);
    }
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        if ($arsip->media) {
            Storage::delete($arsip->media);
        }
        $procurementId = $arsip -> procurement_id;
        $arsip->delete();

        return redirect()->route('procurement.details', ['procurementId' => $procurementId]);
    }
}
