<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class TemaController extends Controller
{
    // Menampilkan semua tema
    public function index(Request $request)
    {
        $tema = Tema::all(); // Ambil semua data tema
        return Inertia::render('Setting/Index', ['tema' => $tema]); // Kirim data tema ke halaman Tema
    }

    // Menyimpan tema baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'teks_tema' => 'string',
            'foto_tema' => 'nullable|file|mimes:jpg,png,jpeg'
        ]);


        if ($request->file('foto_tema')) {
            $validated['foto_tema'] = $request->file('foto_tema')->store('assets-theme');
        }

        Tema::create($validated);

        return redirect()->route('tema')->with('success', 'Tema berhasil ditambahkan.');
    }

    // Menampilkan halaman edit tema
    public function edit(Tema $tema)
    {
        return Inertia::render('Setting/Edit', compact('tema'));
    }
    
    public function update(Request $request, $id)
    {
        $validated = $request -> validate([
            'teks_tema' => 'string',
            'foto_tema' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]) ;

        $tema = Tema::findOrFail($id);

        if ($request->hasFile('foto_tema')) {
            if ($tema->foto_tema) {
                Storage::delete($tema->foto_tema);
            }
            $validated['foto_tema'] = $request->file('foto_tema')->store('assets-theme');
        } else {
            $validated['foto_tema'] = $tema->foto_tema;
        }
    
        $tema->update($validated);
    
        return redirect()->route('tema')->with('success', 'Tema berhasil diperbarui.');
    }
    
    // Menampilkan halaman create tema
    public function create()
    {
        return Inertia::render('Setting/Create');
    }

    public function viewTheme()
    {
        $tema = Tema::findOrFail(1); // Ambil data tema dengan ID 1
        return Inertia::render('Welcome', [
            'foto_tema' => $tema->foto_tema,
            'teks_tema' => $tema->teks_tema,
        ]);
    }
    public function viewThemeInContact()
    {
        $tema = Tema::findOrFail(1); // Ambil data tema dengan ID 1
        // dd($tema);
        return Inertia::render('Kontak', [
            'foto_tema' => $tema->foto_tema,
            'teks_tema' => $tema->teks_tema,
        ]);
    }
    

}
