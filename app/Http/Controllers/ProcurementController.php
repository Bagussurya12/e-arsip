<?php

namespace App\Http\Controllers;

use App\Models\Procurement;
use App\Models\Arsip;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;

class ProcurementController extends Controller
{
    /**
     * Display a listing of procurements.
     */
    public function index()
    {
        $procurements = Procurement::orderBy('id', 'DESC')->get();
        return inertia('Procurement/Index', [
            'procurements' => $procurements,
        ]);
    }

    /**
     * Show the form for creating a new procurement.
     */
    public function create()
    {
        return inertia('Procurement/Create');
    }

    /**
     * Store a newly created procurement in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'tanggal' => 'nullable|integer',
            'bulan' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'division' => 'nullable|string',
            'status' => 'nullable|string',
            'procurement_number' => 'nullable|string|unique:procurements,procurement_number',
            'remarks' => 'nullable|string',
        ]);

        Procurement::create($validated);

        return redirect()->route('procurement.index')
            ->with('success_message', 'Procurement created successfully!');
    }

        /**
     * Show the form for editing the specified procurement.
     */
    public function edit($id)
    {
        $procurement = Procurement::findOrFail($id);

        return inertia('Procurement/Edit', [
            'procurement' => $procurement,
        ]);
    }

    /**
     * Update the specified procurement in the database.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'nullable|string',
            'tanggal' => 'nullable|integer',
            'bulan' => 'nullable|string',
            'tahun' => 'nullable|integer',
            'division' => 'nullable|string',
            'status' => 'nullable|string',
            'procurement_number' => 'nullable|string|unique:procurements,procurement_number,' . $id,
            'remarks' => 'nullable|string',
        ]);

        $procurement = Procurement::find($id);
        $procurement->update($validated);

        return redirect()->route('procurement.index');
    }

    /**
     * Remove the specified procurement from the database.
     */
    public function destroy($id)
    {
        $procurement = Procurement::findOrFail($id);
        $procurement->delete();

        return redirect()->route('procurement.index')
            ->with('success_message', 'Procurement deleted successfully!');
    }


    // Details
    public function details($id)
    {
        $procurement = Procurement::findOrFail($id);
        $arsip = Arsip::where('procurement_id', $id)->get();
        $dokumentasi = Dokumentasi::where('procurement_id', $id)->get();

        // Urutkan bulan_options berdasarkan urutan bulan standar

        return Inertia('Procurement/Details', [
            'procurement' => $procurement,
            'arsip' => $arsip,
            'dokumentasi' => $dokumentasi
        ]);
    }
}
