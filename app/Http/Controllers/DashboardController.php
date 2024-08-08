<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mendapatkan tanggal hari ini
        $today = Carbon::now();

        // Mengambil tanggal dan waktu 7 hari yang lalu
        $date = Carbon::now()->subDays(7);

        // Mendapatkan tanggal Jumat pekan lalu
        $lastFriday = $today->subWeek()->previous(Carbon::FRIDAY);

        // Menghitung total dana masuk pada hari Jumat pekan lalu
        $totalDanaMasukLastFriday = DanaMasuk::whereDate('tanggal', $lastFriday->toDateString())->sum('nominal');

        // Mengambil tanggal dan waktu 14 hari dan 7 hari yang lalu
        $startOfLastWeek = Carbon::now()->subDays(14);
        $endOfLastWeek = Carbon::now()->subDays(7);

        // Menjumlahkan nominal dana masuk dan keluar dari pekan lalu (7 hingga 14 hari yang lalu)
        $totalLastWeekMasuk = DanaMasuk::whereBetween('tanggal', [$startOfLastWeek, $endOfLastWeek])->sum('nominal');
        $totalLastWeekKeluar = DanaKeluar::whereBetween('tanggal', [$startOfLastWeek, $endOfLastWeek])->sum('nominal');

        // Menghitung total saldo pekan lalu
        $totallast14DaysKeluar = $totalLastWeekMasuk - $totalLastWeekKeluar;

        // Menjumlahkan nominal dari dana masuk dan dana keluar dalam 7 hari terakhir
        $totalLast7DaysMasuk = DanaMasuk::where('tanggal', '>=', $date)->sum('nominal');
        $totalLast7DaysKeluar = DanaKeluar::where('tanggal', '>=', $date)->sum('nominal');

        // Menghitung total saldo selama sepekan
        $totalSaldoSepekan = $totalLast7DaysMasuk - $totalLast7DaysKeluar;

        // Menjumlahkan seluruh dana masuk dan keluar dari data yang sudah diinputkan ke database
        $totalMasuk = DanaMasuk::sum('nominal');
        $totalKeluar = DanaKeluar::sum('nominal');

        // Menghitung total saldo bersih dari data yang sudah diinputkan ke database
        $totalSaldo = $totalMasuk - $totalKeluar;

        // Mengambil data dana masuk dari model DanaMasuk
        $dataDanaMasuk = DanaMasuk::all();

        // Mengambil data dana keluar dari model DanaKeluar
        $dataDanaKeluar = DanaKeluar::all();



        return view('dashboard.index')
        ->with('totalLast7DaysMasuk', $totalLast7DaysMasuk)
        ->with('totalLast7DaysKeluar', $totalLast7DaysKeluar)
        ->with('totalSaldoSepekan', $totalSaldoSepekan)
        ->with('dataDanaMasuk', $dataDanaMasuk)
        ->with('dataDanaKeluar', $dataDanaKeluar)
        ->with('totalMasuk', $totalMasuk)
        ->with('totalKeluar', $totalKeluar)
        ->with('totalSaldo', $totalSaldo)
        ->with('totalDanaMasukLastFriday', $totalDanaMasukLastFriday)
        ->with('totallast14DaysKeluar', $totallast14DaysKeluar);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
