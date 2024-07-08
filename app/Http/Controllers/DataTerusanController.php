<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Terusan;

class DataTerusanController extends Controller
{

    public function index()
    {
        $terusans = Terusan::orderBy('id', 'DESC')->get();

        return inertia('Terusan/Index', [
            'terusans' => $terusans,
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

        return redirect()->route('terusan.index')
            ->with('success', 'Data terusan berhasil diperbarui.');
    }

    public function destroy(Terusan $terusan)
    {
        $terusan->delete();

        return redirect()->route('terusan.index')
            ->with('success', 'Data terusan berhasil dihapus.');
    }
}
