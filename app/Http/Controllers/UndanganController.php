<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Undangan;

class UndanganController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request -> validate([
            'disposisi_acara' => 'string',
            'notulen' => 'string',
            'keterangan' => 'string',
            'foto_kegiatan' =>'file|mimes:jpg,png,jpeg,pdf,mp4,mp3',

        ]);

        if($request -> file('foto_kegiatan')){
            $validated['foto_kegiatan'] = $request->file('foto_kegiatan')->store('assets_ArsipUndangan');
        }
        $undangan = Undangan::create($validated);
    }
}
