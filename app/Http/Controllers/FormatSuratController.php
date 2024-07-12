<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formatSurat;

class FormatSuratController extends Controller
{
    //
    public function index()
    {
        $format_surat = formatSurat::orderBy('id', 'DESC')-> get();

        return inertia('Format/Index', [
            'format_surat' => $format_surat
        ]);
    }
}
