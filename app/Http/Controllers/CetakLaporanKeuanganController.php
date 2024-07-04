<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanKeuanganController extends Controller
{
    public function cetakLaporan(){

        // Menghitung tanggal seminggu yang lalu dari sekarang
        $tanggalMulai = Carbon::now()->subDays(7);

        $dataDanaMasuk = DanaMasuk::where('tanggal', '>=', $tanggalMulai)->get();

        $dataDanaKeluar = DanaKeluar::where('tanggal', '>=', $tanggalMulai)->get();

        $totalDanaMasuk = $dataDanaMasuk->sum('nominal');
        $totalDanaKeluar = $dataDanaKeluar->sum('nominal');

        return view('laporan.cetak', compact('tanggalMulai', 'dataDanaMasuk', 'dataDanaKeluar', 'totalDanaMasuk', 'totalDanaKeluar'));
    }
}
