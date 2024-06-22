<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function showContactForm()
    {
        return Inertia::render('Kontak');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string',
            'email' => 'email',
            'phone' => 'integer',
            'institution' => 'string',
            'message' => 'string'
        ]);
    
        Kontak::create($validated);
    
        return redirect()->back()->with('success', 'Pesan Anda berhasil terkirim!');
    }
    
}
