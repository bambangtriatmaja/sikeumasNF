<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CetakLaporanKeuanganController extends Controller
{
    public function cetakLaporan(){

        // Mendapatkan tanggal hari ini
        $today = Carbon::now();

        // Mengambil tanggal dan waktu 7 hari yang lalu
        $date = Carbon::now()->subDays(7);

        // Mendapatkan tanggal Jumat pekan lalu
        $lastFriday = $today->subWeek()->previous(Carbon::FRIDAY);

        // Menghitung total dana masuk pada hari Jumat pekan lalu
        $totalDanaMasukLastFriday = DanaMasuk::whereDate('tanggal', $lastFriday->toDateString())->sum('nominal');

        // Menjumlahkan nominal dari dana masuk dan dana keluar dalam 7 hari terakhir
        $totalLast7DaysMasuk = DanaMasuk::where('tanggal', '>=', $date)->sum('nominal');
        $totalLast7DaysKeluar = DanaKeluar::where('tanggal', '>=', $date)->sum('nominal');

        // Menjumlahkan seluruh dana masuk dan keluar dari data yang sudah diinputkan ke database
        $totalMasuk = DanaMasuk::sum('nominal');
        $totalKeluar = DanaKeluar::sum('nominal');

        // Menghitung total saldo bersih dari data yang sudah diinputkan ke database
        $totalSaldo = $totalMasuk - $totalKeluar;

        $dataDanaMasuk = DanaMasuk::where('tanggal', '>=', $date)->get();

        $dataDanaKeluar = DanaKeluar::where('tanggal', '>=', $date)->get();

        return view('laporan.cetak', compact('today', 'totalDanaMasukLastFriday', 'totalLast7DaysMasuk', 'totalLast7DaysKeluar', 'totalSaldo', 'dataDanaMasuk', 'dataDanaKeluar'));
    }
}
