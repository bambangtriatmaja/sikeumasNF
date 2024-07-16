<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FilterLaporanController extends Controller
{
    public function filter(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil tanggal dari input form
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data berdasarkan rentang tanggal yang dipilih

        $dataDanaMasuk = DanaMasuk::whereBetween('tanggal', [$startDate, $endDate])->get();
        $dataDanaKeluar = DanaKeluar::whereBetween('tanggal', [$startDate, $endDate])->get();

        return view('home', compact('dataDanaMasuk', 'dataDanaKeluar', 'startDate', 'endDate'));
    }
}
