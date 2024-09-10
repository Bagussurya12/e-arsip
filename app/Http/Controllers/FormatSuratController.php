<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Update Format
use App\Models\FormatSurat;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class FormatSuratController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $format_surat = FormatSurat::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->get();

        return Inertia('Format/Index', [
            'format_surat' => $format_surat,
            'search' => $search,
        ]);
    }



    public function create()
    {
        return inertia('Format/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'file_surat' => 'file|mimes:pdf,doc,docx',
        ]);

        if ($request->file('file_surat')) {
            $validated['file_surat'] = $request->file('file_surat')->store('assets-format');
        }
        FormatSurat::create($validated);
        return redirect()->route('format.index');
    }

    public function edit(FormatSurat $format)
    {
        return Inertia::render('Format/Edit', [
            'format_surat' => $format
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        $format_surat = FormatSurat::findOrFail($id);

        if ($request->hasFile('file_surat')) {
            if ($format_surat->file_surat) {
                Storage::delete($format_surat->file_surat);
            }
            $validated['file_surat'] = $request->file('file_surat')->store('assets-format');
        } else {
            $validated['file_surat'] = $format_surat->file_surat;
        }

        $format_surat->update($validated);

        return redirect()->route('format.index');
    }

    public function destroy($id)
    {
        $format = FormatSurat::findOrFail($id);

        if ($format->file_surat) {
            Storage::delete($format->file_surat);
        }
        $format->delete();

        return redirect()->route('format.index');
    }

    public function indexForUser(Request $request)
    {
        $search = $request->input('search');

        $format_surat = FormatSurat::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('id', 'DESC')
            ->get();

        return Inertia('Format/User/Index', [
            'format_surat' => $format_surat,
            'search' => $search,
        ]);
    }

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
