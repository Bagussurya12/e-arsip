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
            'name' => 'string|required',
            'email' => 'email|required',
            'phone' => 'integer|required',
            'institution' => 'string|required',
            'message' => 'string|required'
        ]);
    
        Kontak::create($validated);
    
        return redirect()->back()->with('success', 'Pesan Anda berhasil terkirim!');
    }

    public function index(Request $request)
    {
        $query = Kontak::query();

        if ($request->has('search')){
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        $kontak = $query->paginate(30);

        return Inertia::render('Message/Index', [
            'kontak' => $kontak
        ]);
    }
}
