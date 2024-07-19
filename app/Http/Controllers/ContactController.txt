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
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|integer',
            'institution' => 'required|string',
            'message' => 'required|string'
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

    public function detail($id)
    {
         // Mengambil data pesan berdasarkan ID
         $kontak = Kontak::findOrFail($id);

         // Mengembalikan view dengan data pesan
         return Inertia::render('Message/Detail', [
             'kontak' => $kontak,
         ]);
    }

    public function destroy($id)
    {
        $kontak = Kontak::findOrFail($id);
    

        $kontak->delete();
    
        return redirect(route('pesan'))->with('success', 'Data Pesan berhasil dihapus');
    }
}
