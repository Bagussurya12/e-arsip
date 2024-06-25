<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use Inertia\Inertia;

class StatisticsController extends Controller
{
    public function statisticKeterangan(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $totalSuratMasuk = Arsip::where('keterangan', 'Surat Masuk')
            ->when($month, function ($query, $month) {
                return $query->where('map_bulan', $month);
            })
            ->when($year, function ($query, $year) {
                return $query->where('tahun', $year);
            })
            ->count();

        $totalSuratKeluar = Arsip::where('keterangan', 'Surat Keluar')
            ->when($month, function ($query, $month) {
                return $query->where('map_bulan', $month);
            })
            ->when($year, function ($query, $year) {
                return $query->where('tahun', $year);
            })
            ->count();

        return Inertia::render('Statistic/Index', [
            'totalSuratMasuk' => $totalSuratMasuk,
            'totalSuratKeluar' => $totalSuratKeluar,
            'month' => $month,
            'year' => $year,
        ]);
    }
}
