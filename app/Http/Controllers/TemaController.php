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
            'teks_tema' => 'required|string',
            'foto_tema' => 'nullable|file|mimes:jpg,png,jpeg'
        ]);

        if ($request->file('foto_tema')) {
            $validated['foto_tema'] = $request->file('foto_tema')->store('assets-theme');
        }

        Tema::create($validated);

        return redirect()->route('setting')->with('success', 'Tema berhasil ditambahkan.');
    }

    // Menampilkan halaman edit tema
    public function edit(Tema $tema)
    {
        return Inertia::render('Setting/Edit', compact('tema'));
    }

    // Mengupdate tema yang ada
    public function update(Request $request, $id)
    {
        $tema = Tema::findOrFail($id);
    
        $validated = $request->validate([
            'teks_tema' => 'string',
            'foto_tema' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        // Handle file upload
        if ($request->hasFile('foto_tema')) {
            // Delete old photo if exists
            if ($tema->foto_tema) {
                Storage::delete($tema->foto_tema);
            }
            // Store new photo
            $tema->foto_tema = $request->file('foto_tema')->store('public/assets-theme');
        }
    
        // Update text theme if provided
        if (isset($validated['teks_tema'])) {
            $tema->teks_tema = $validated['teks_tema'];
        }
    
        // Save the updated tema
        $tema->save();
    
        return redirect()->route('setting')->with('success', 'Tema berhasil diperbarui.');
    }
    
    
    // Menampilkan halaman create tema
    public function create()
    {
        return Inertia::render('Setting/Create');
    }
}
