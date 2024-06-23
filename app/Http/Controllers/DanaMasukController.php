<?php

namespace App\Http\Controllers;

use App\Models\DanaMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DanaMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil tanggal dan waktu 7 hari yang lalu
        $date = Carbon::now()->subDays(7);

        // Menjumlahkan nominal dari database yang dibuat dalam 7 hari terakhir
        $totalLast7Days = DanaMasuk::where('tanggal', '>=', $date)->sum('nominal');

        $katakunci = $request->katakunci;
        $jumlahbaris = 7;

        if(strlen($katakunci)){
            $data = DanaMasuk::where('tanggal', 'like', "%$katakunci%")
            ->orWhere('ket_pemasukan', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else{
            $data = DanaMasuk::orderBy('tanggal', 'desc')->paginate($jumlahbaris);
        };
        return view('dana_masuk.index')
        ->with('data', $data)
        ->with('totalLast7Days', $totalLast7Days);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dana_masuk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('tanggal', $request->tanggal);
        Session::flash('nominal', $request->nominal);
        Session::flash('ket_pemasukan', $request->ket_pemasukan);

        $request->validate([
            'tanggal' => 'required',
            'nominal' =>'required|numeric',
            'ket_pemasukan'=>'required',
        ],[
            'tanggal.required' => 'Tanggal wajib dipilih',
            'nominal.required' => 'Nominal wajib diisi',
            'ket_pemasukan.required'=>'Keterangan pemasukan wajib diisi',
        ]);
        $data = [
            'tanggal'=>$request->tanggal,
            'nominal'=>$request->nominal,
            'ket_pemasukan'=>$request->ket_pemasukan,
        ];

        DanaMasuk::create($data);
        return redirect()->to('dana_masuk')->with('success', 'Data berhasil ditambahkan');
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
        $data = DanaMasuk::where('tanggal', $id)->first();
        return view('dana_masuk.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal' => 'required',
            'nominal' =>'required|numeric',
            'ket_pemasukan'=>'required',
        ],[
            'tanggal.required' => 'Tanggal wajib dipilih',
            'nominal.required' => 'Nominal wajib diisi',
            'ket_pemasukan.required'=>'Keterangan pemasukan wajib diisi',
        ]);
        $data = [
            'tanggal'=>$request->tanggal,
            'nominal'=>$request->nominal,
            'ket_pemasukan'=>$request->ket_pemasukan,
        ];

        DanaMasuk::where('tanggal', $id)->update($data);
        return redirect()->to('dana_masuk')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DanaMasuk::where('tanggal', $id)->delete();
        return redirect()->to('dana_masuk')->with('success', 'Data berhasil dihapus');
    }
}
