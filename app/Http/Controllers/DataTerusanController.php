<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terusan;
use Inertia\Inertia;

class DataTerusanController extends Controller
{

    public function index()
    {
        $terusan = Terusan::orderBy('id', 'DESC')->get();

        return inertia('Terusan/Index', [
            'terusan' => $terusan,
        ]);
    }

    public function create()
    {
        return inertia('Terusan/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string',
        ]);

        Terusan::create([
            'value' => $request->value,
        ]);

        return redirect()->route('terusan')
            ->with('success', 'Data terusan berhasil ditambahkan.');
    }

    public function edit(Terusan $terusan)
    {
        return inertia('Terusan/Edit', [
            'terusan' => $terusan,
        ]);
    }

    public function update(Request $request, Terusan $terusan)
    {
        $request->validate([
            'value' => 'required|string',
        ]);

        $terusan->update([
            'value' => $request->value,
        ]);

        return redirect()->route('terusan')
            ->with('success', 'Data terusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $terusan = Terusan::findOrFail($id);
        $terusan -> delete();

        return redirect()->route('terusan')
            ->with('success', 'Data terusan berhasil dihapus.');
    }

}
