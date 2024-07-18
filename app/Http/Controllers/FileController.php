<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function uploadPreview(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('temp-previews');
            $url = Storage::url($path);
            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}