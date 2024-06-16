<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Arsip;
use App\Models\LokasiSimpan;
use App\Models\MediaArsip;

class ArsipController extends Controller
{
    // Menyimpan arsip beserta lokasi simpan dan media arsip
    public function store(Request $request)
    {
        // Validasi request
        // $request->validate([
        //     'jenis_arsip' => 'required|string',
        //     'uraian_informasi' => 'required|string',
        //     'tanggal_surat' => 'required|date',
        //     'nomor_urut_perbulan' => 'required|integer',
        //     'nomor_dokumen' => 'required|string',
        //     'jumlah' => 'nullable|integer',
        //     'tingkat_perkembangan' => 'required|string',
        //     'keterangan' => 'required|in:Surat Masuk,Surat Keluar',
        //     'lemari' => 'required|integer',
        //     'no_bindeks' => 'required|integer',
        //     'map_bulan' => 'nullable|string',
        //     'jenis_media' => 'required|string',
        //     'nama_media' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3', // Menambah validasi file
        // ]);
    
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
        $lokasi_simpan = LokasiSimpan::create([
            'arsip_id' => $arsip->id,
            'kolom_lemari' => $request->kolom_lemari,
            'no_bindeks' => $request->no_bindeks,
            'map_bulan' => $request->map_bulan,
        ]);
    
        // Simpan file media arsip jika ada
        if ($request->hasFile('nama_media')) {
            $file = $request->file('nama_media');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('assets_backend', $filename);
    
            $media_arsip = MediaArsip::create([
                'arsip_id' => $arsip->id,
                'jenis_media' => $request->jenis_media,
                'nama_media' => $filename, // Simpan nama file
            ]);
        }
        
        return  redirect()->back()->with('success','Data Berhasil Di Simpan');
        
    }

    // Mengambil data arsip beserta lokasi simpan dan media arsip
    public function index(Request $request) {
        // Memuat relasi 'lokasiSimpan' dan 'mediaArsip' dengan menggunakan metode 'with'
        $query = Arsip::with(['LokasiSimpan', 'MediaArsip']);
    
        // Melakukan paginasi hasil query
        $arsip = $query->paginate(20);
    
        // Mengembalikan hasil ke view dengan menggunakan Inertia
        return Inertia::render('Arsip/Index', [
            'arsip' => $arsip
        ]);
    }
    public function create()
    {
        return Inertia::render('Arsip/Create');
    }
}
