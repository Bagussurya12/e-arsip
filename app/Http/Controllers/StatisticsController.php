<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use Inertia\Inertia;

class StatisticsController extends Controller
{
    public function statisticKeterangan(Request $request)
    {
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $totalSuratMasuk = Arsip::where('keterangan', 'Surat Masuk')
            ->when($bulan, function ($query, $bulan) {
                return $query->where('bulan', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            ->count();

        $totalSuratKeluar = Arsip::where('keterangan', 'Surat Keluar')
            ->when($bulan, function ($query, $bulan) {
                return $query->where('bulan', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            ->count();

        // Get statistics by type of letters
        $jenisSurat = Arsip::select('jenis_surat', \DB::raw('count(*) as total'))
            ->when($bulan, function ($query, $bulan) {
                return $query->where('bulan', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            ->groupBy('jenis_surat')
            ->get()
            ->pluck('total', 'jenis_surat')
            ->toArray();

        // Get data arsip with pagination
        $dataArsip = Arsip::when($bulan, function ($query, $bulan) {
                return $query->where('bulan', $bulan);
            })
            ->when($tahun, function ($query, $tahun) {
                return $query->where('tahun', $tahun);
            })
            ->paginate(10);

        return Inertia::render('Statistic/Index', [
            'totalSuratMasuk' => $totalSuratMasuk,
            'totalSuratKeluar' => $totalSuratKeluar,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'jenisSurat' => $jenisSurat,
            'dataArsip' => $dataArsip,
        ]);
    }
}
