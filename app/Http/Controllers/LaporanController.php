<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use Illuminate\Http\Request;
use App\Models\laporan;
use App\Models\LaporanKeuangan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(){

        $date = Carbon::now()->subDays(7);

        // Mengambil data dana masuk selama 7 hari terakhir
        $dataDanaMasuk = DanaMasuk::where('tanggal', '>=', $date)->get();

        // Mengambil data dana keluar selama 7 hari terakhir
        $dataDanaKeluar = DanaKeluar::where('tanggal', '>=', $date)->get();

        $totalLast7DaysMasuk = DanaMasuk::where('tanggal', '>=', $date)->sum('nominal');
        $totalLast7DaysKeluar = DanaKeluar::where('tanggal', '>=', $date)->sum('nominal');

        // Menjumlahkan seluruh dana masuk dan keluar dari data yang sudah diinputkan ke database
        $totalMasuk = DanaMasuk::sum('nominal');
        $totalKeluar = DanaKeluar::sum('nominal');

        // Menghitung total saldo bersih dari data yang sudah diinputkan ke database
        $totalSaldo = $totalMasuk - $totalKeluar;

        return view('home')
        ->with('dataDanaMasuk', $dataDanaMasuk)
        ->with('dataDanaKeluar', $dataDanaKeluar)
        ->with('totalLast7DaysMasuk', $totalLast7DaysMasuk)
        ->with('totalLast7DaysKeluar', $totalLast7DaysKeluar)
        ->with('totalSaldo', $totalSaldo);
    }

}
