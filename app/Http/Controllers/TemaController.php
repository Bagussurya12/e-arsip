<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemaController extends Controller
{
    // public function showTema()
    // {
    //     $tema = Tema::all(); // Ambil semua data tema
    //     return Inertia::render('/', ['tema' => $tema]); // Kirim data tema ke halaman Tema
    // }

    public function index(Request $request)
    {
        $tema = Tema::all(); // Ambil semua data tema
        return Inertia::render('Setting/Index', ['tema' => $tema]); // Kirim data tema ke halaman Tema
    }
}
