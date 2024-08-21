<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Arsip;
use App\Models\LokasiSimpan;
use App\Models\Undangan;
use App\Models\Terusan;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArsipController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query dasar untuk model Arsip dan menyertakan relasi 'lokasiSimpan'
        $query = Arsip::with(['lokasiSimpan', 'notaDinas']);

        
        // Memeriksa apakah ada parameter pencarian dan memastikan nilainya tidak kosong
        if ($request->has('naskahDinas') && !empty($request->input('naskahDinas'))) {
            $query->where('jenis_surat', 'like', '%' . $request->input('naskahDinas') . '%');
        }
    
        if ($request->has('asalSurat') && !empty($request->input('asalSurat'))) {
            $query->where('asal_surat', 'like', '%' . $request->input('asalSurat') . '%');
        }
    
        if ($request->has('uraianInformasi') && !empty($request->input('uraianInformasi'))) {
            $query->where('uraian_informasi', 'like', '%' . $request->input('uraianInformasi') . '%');
        }
    
        if ($request->has('tanggal') && !empty($request->input('tanggal'))) {
            $query->where('tanggal', 'like', '%' . $request->input('tanggal') . '%');
        }
    
        if ($request->has('bulan') && !empty($request->input('bulan'))) {
            $query->where('bulan', 'like', '%' . $request->input('bulan') . '%');
        }
    
        if ($request->has('tahun') && !empty($request->input('tahun'))) {
            $query->where('tahun', 'like', '%' . $request->input('tahun') . '%');
        }
        
        // Mengurutkan hasil berdasarkan kolom 'created_at' dari yang terbaru ke yang terlama
        $query->orderBy('created_at', 'desc');
    
        // Mengambil hasil pencarian dengan paginasi, 20 item per halaman
        $arsip = $query->paginate(20);
    
        // Mengirimkan hasil pencarian dan filter yang diterapkan ke tampilan frontend dengan Inertia.js
        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip,
            'filters' => $request->all(), // Mengirimkan filter yang diterapkan ke frontend
        ]);
    }
    

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
                $undangan->foto_kegiatan = $request->file('foto_kegiatan')->store('assets-arsip');
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
        $terusan = Terusan::all();
        return Inertia::render('Arsip/Create', ['terusan' => $terusan]);
    }

    public function edit($id)
    {
        $arsip = Arsip::with('lokasiSimpan', 'undangan')->find($id);
        $terusan = Terusan::all();
        return Inertia::render('Arsip/Edit', [
            'arsip' => $arsip,
            'terusan' => $terusan
        ]);
    }
    public function arsip_detail($id)
    {
        $arsip = Arsip::with('lokasiSimpan', 'undangan')->find($id);
        return Inertia::render('Arsip/Detail', [
            'arsip' => $arsip
        ]);
    }

    public function update(Request $request, $id)
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

    // Method untuk mengambil arsip terbaru dalam 3 hari terakhir
    public function getArsipTerbaru()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);
        $arsipTerbaru = Arsip::with('lokasiSimpan', 'undangan')
            ->where('created_at', '>=', $threeDaysAgo)
            ->get();

        return Inertia::render('Dashboard', [
            'arsipTerbaru' => $arsipTerbaru
        ]);
    }
}
