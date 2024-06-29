<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Undangan;

class UndanganController extends Controller
{
    //
    public function store(Request $request)
    {
        $validated = $request->validate([
            'diposisi_acara' => 'nullable|string|max:255',
            'notulen' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
            'foto_kegiatan' => 'nullable|file|mimes:jpg,png,jpeg,pdf,mp4,mp3|max:2048',
        ]);

        if ($request->hasFile('foto_kegiatan')) {
            $validated['foto_kegiatan'] = $request->file('foto_kegiatan')->store('assets_ArsipUndangan', 'public');
        }

        $undangan = Undangan::create($validated);

        return redirect()->back()->with('success', 'Data undangan berhasil disimpan!');
    }
}
