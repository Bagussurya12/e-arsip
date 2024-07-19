<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->file('file')) {
            $file = $request->file('file');
            $path = $file->store('public/uploads');

            // Dapatkan URL publik dari file yang diunggah
            $url = Storage::url($path);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'File not uploaded'], 400);
    }
}