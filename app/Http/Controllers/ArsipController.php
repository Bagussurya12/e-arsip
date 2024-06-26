<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Arsip;
use App\Models\LokasiSimpan;
use Illuminate\Support\Facades\Storage;

class ArsipController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'in:Surat Masuk,Surat Keluar',
            'jenis_surat' => 'string',
            'asal_surat' => 'string',
            'tanggal' => 'integer',
            'bulan' => 'string',
            'tahun' => 'integer',
            'uraian_informasi' => 'string',
            'nomor_urut_perbulan' => 'integer',
            'nomor_dokumen' => 'string',
            'kolom_lemari' => 'integer',
            'kotak' => 'in: A, B',
            'jumlah' => 'integer',
            'tingkat_perkembangan' => 'string',
            'disposisi' => 'string',
            'terusan' => 'string',
            'jenis_media' => 'string',
            'media' => 'file|mimes:jpg,png,jpeg,pdf,mp4,mp3',
        ]);

        if ($request->file('media')) {
            $validated['media'] = $request->file('media')->store('assets-arsip');
        }

        $arsip = Arsip::create($validated);

        LokasiSimpan::create([
            'arsip_id' => $arsip->id,
            'kolom_lemari' => $request->kolom_lemari,
            'kotak' => $request->kotak
        ]);

        return redirect()->route('arsip');
    }

    public function index(Request $request)
    {
        $query = Arsip::with('lokasiSimpan');

        // Filter berdasarkan jenis naskah dinas
        if ($request->has('naskahDinas')) {
            $query->where('jenis_arsip', 'like', '%' . $request->input('naskahDinas') . '%');
        }

        // Filter berdasarkan uraian informasi
        if ($request->has('searchQuery')) {
            $query->where('uraian_informasi', 'like', '%' . $request->input('searchQuery') . '%');
        }

        // Filter berdasarkan bulan
        if ($request->has('filterBulan')) {
            $query->where('map_bulan', 'like', '%' . $request->input('filterBulan') . '%');
        }

        // Filter berdasarkan tahun
        if ($request->has('filterTahun')) {
            $query->where('tahun', $request->input('filterTahun'));
        }

        // Filter berdasarkan media arsip
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
    
        // Filter berdasarkan jenis naskah dinas
        if ($request->has('naskahDinas')) {
            $query->where('jenis_arsip', 'like', '%' . $request->input('naskahDinas') . '%');
        }
    
        // Filter berdasarkan uraian informasi
        if ($request->has('searchQuery')) {
            $query->where('uraian_informasi', 'like', '%' . $request->input('searchQuery') . '%');
        }
    
        // Filter berdasarkan bulan
        if ($request->has('filterBulan')) {
            $query->where('map_bulan', 'like', '%' . $request->input('filterBulan') . '%');
        }
    
        // Filter berdasarkan tahun
        if ($request->has('filterTahun')) {
            $query->where('tahun', $request->input('filterTahun'));
        }
    
        // Filter berdasarkan media arsip
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
            'media' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3', // Update validation
        ]);
    
        $arsip = Arsip::findOrFail($id);
    
        if ($request->hasFile('media')) {
            // Delete the old file if a new file is uploaded.
            if ($arsip->media) {
                Storage::delete($arsip->media);
            }
            $validated['media'] = $request->file('media')->store('assets-arsip');
        } else {
            // Retain the old file if no new file is uploaded.
            $validated['media'] = $arsip->media;
        }
    
        $arsip->update($validated);
    
        if ($arsip->lokasiSimpan) {
            $arsip->lokasiSimpan->update([
                'kolom_lemari' => $request->kolom_lemari,
                'no_bindeks' => $request->no_bindeks,
                'map_bulan' => $request->map_bulan,
                'tahun' => $request->tahun,
            ]);
        } else {
            LokasiSimpan::create([
                'arsip_id' => $arsip->id,
                'kolom_lemari' => $request->kolom_lemari,
                'no_bindeks' => $request->no_bindeks,
                'map_bulan' => $request->map_bulan,
                'tahun' => $request -> tahun,
            ]);
        }
    
        return redirect()->route('arsip')->with('success', 'Data arsip berhasil diperbarui');
    }

    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);
    
        // Hapus media terkait jika ada
        if ($arsip->media) {
            Storage::delete($arsip->media);
        }
    
        $arsip->delete();
    
        return redirect(route('arsip'))->with('success', 'Data arsip berhasil dihapus');
    }
}
