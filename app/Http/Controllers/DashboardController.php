<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use App\Models\DanaMasuk;
use App\Models\LaporanKeuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil tanggal dan waktu 7 hari yang lalu
        $date = Carbon::now()->subDays(7);

        // Menjumlahkan nominal dari dana masuk dan dana keluar dalam 7 hari terakhir
        $totalLast7DaysMasuk = DanaMasuk::where('tanggal', '>=', $date)->sum('nominal');
        $totalLast7DaysKeluar = DanaKeluar::where('tanggal', '>=', $date)->sum('nominal');

        // Menghitung total saldo
        $totalSaldo = $totalLast7DaysMasuk - $totalLast7DaysKeluar;

        // Mengambil data dana masuk dari model DanaMasuk
        $dataDanaMasuk = DanaMasuk::all();

        // Mengambil data dana keluar dari model DanaKeluar
        $dataDanaKeluar = DanaKeluar::all();

        return view('dashboard.index')
        ->with('totalLast7DaysMasuk', $totalLast7DaysMasuk)
        ->with('totalLast7DaysKeluar', $totalLast7DaysKeluar)
        ->with('totalSaldo', $totalSaldo)
        ->with('dataDanaMasuk', $dataDanaMasuk)
        ->with('dataDanaKeluar', $dataDanaKeluar);
        
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
        Session::flash('tanggal', $request->tanggal);
        Session::flash('infaq', $request->infaq);
        Session::flash('pengeluaran', $request->pengeluaran);
        Session::flash('ket_pengeluaran', $request->ket_pengeluaran);
        Session::flash('saldo_akhir', $request->saldo_akhir);

        $request->validate([
            'tanggal' => 'required',
            'infaq' =>'required|numeric',
            'pengeluaran' => 'required|numeric',
            'ket_pengeluaran' => 'required',
            'saldo_akhir' => 'required|numeric',
        ],[
            'tanggal.required' => 'Tanggal wajib dipilih',
            'infaq.required' => 'Infaq wajib diisi',
            'infaq.numeric' => 'Infaq wajib berupa angka',
            'pengeluaran.required' => 'Pengeluaran wajib diisi',
            'pengeluaran.numeric' => 'Pengeluaran wajib berupa angka',
            'ket_pengeluaran.required' => 'Keterangan Pengeluaran wajib diisi',
            'saldo_akhir.required' => 'Saldo Akhir wajib diisi',
            'saldo_akhir.numeric' => 'Saldo Akhir wajib berupa angka',
        ]);
        $data = [
            'tanggal'=>$request->tanggal,
            'infaq'=>$request->infaq,
            'pengeluaran'=>$request->pengeluaran,
            'ket_pengeluaran'=>$request->ket_pengeluaran,
            'saldo_akhir'=>$request->saldo_akhir,
        ];

        LaporanKeuangan::create($data);
        return redirect()->to('dashboard')->with('success', 'Data berhasil ditambahkan');
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
        $data = LaporanKeuangan::where('tanggal', $id)->first();
        return view('dashboard.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'infaq' =>'required|numeric',
            'pengeluaran' => 'required|numeric',
            'ket_pengeluaran' => 'required',
            'saldo_akhir' => 'required|numeric',
        ],[
            'infaq.required' => 'Infaq wajib diisi',
            'infaq.numeric' => 'Infaq wajib berupa angka',
            'pengeluaran.required' => 'Pengeluaran wajib diisi',
            'pengeluaran.numeric' => 'Pengeluaran wajib berupa angka',
            'ket_pengeluaran.required' => 'Keterangan Pengeluaran wajib diisi',
            'saldo_akhir.required' => 'Saldo Akhir wajib diisi',
            'saldo_akhir.numeric' => 'Saldo Akhir wajib berupa angka',
        ]);
        $data = [
            'infaq'=>$request->infaq,
            'pengeluaran'=>$request->pengeluaran,
            'ket_pengeluaran'=>$request->ket_pengeluaran,
            'saldo_akhir'=>$request->saldo_akhir,
        ];

        LaporanKeuangan::where('tanggal', $id)->update($data);
        return redirect()->to('dashboard')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        LaporanKeuangan::where('tanggal', $id)->delete();
        return redirect()->to('dashboard')->with('success', 'Data berhasil dihapus');
    }
}
