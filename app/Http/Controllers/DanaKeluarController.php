<?php

namespace App\Http\Controllers;

use App\Models\DanaKeluar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class DanaKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Mengambil tanggal dan waktu 7 hari yang lalu
        $date = Carbon::now()->subDays(7);

        // Menjumlahkan nominal dari database yang dibuat dalam 7 hari terakhir
        $totalLast7Days = DanaKeluar::where('tanggal', '>=', $date)->sum('nominal');
    
        $katakunci = $request->katakunci;
        $jumlahbaris = 7;

        if(strlen($katakunci)){
            $data = DanaKeluar::where('tanggal', 'like', "%$katakunci%")
            ->orWhere('ket_pengeluaran', 'like', "%$katakunci%")
            ->paginate($jumlahbaris);
        }else{
            $data = DanaKeluar::orderBy('tanggal','desc')->paginate($jumlahbaris);
        }

        return view('dana_keluar.index')
        ->with('data', $data)
        ->with('totalLast7Days', $totalLast7Days);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dana_keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('tanggal', $request->tanggal);
        Session::flash('nominal', $request->nominal);
        Session::flash('ket_pengeluaran', $request->ket_pengeluaran);

        $request->validate([
            'tanggal'=>'required',
            'nominal'=>'required',
            'ket_pengeluaran'=>'required',
        ],[
            'tanggal.required'=>'Tanggal wajib diisi',
            'nominal.required'=>'Nominal wajib diisi',
            'ket_pengeluaran.required'=>'Keterangan pengeluaran wajib diisi'
        ]);
        $data = [
            'tanggal'=>$request->tanggal,
            'nominal'=>$request->nominal,
            'ket_pengeluaran'=>$request->ket_pengeluaran,
        ];
        // $request->merge([
        //     'nominal' => str_replace('.', '', $request->nominal),
        // ]);
        DanaKeluar::create($data);
        return redirect()->to('dana_keluar')->with('success','Data berhasil ditambahkan');
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
        $data = DanaKeluar::where('tanggal', $id)->first();
        return view('dana_keluar.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal'=>'required',
            'nominal'=>'required',
            'ket_pengeluaran'=>'required',
        ],[
            'tanggal.required'=>'Tanggal wajib diisi',
            'nominal.required'=>'Nominal wajib diisi',
            'ket_pengeluaran.required'=>'Keterangan pengeluaran wajib diisi'
        ]);
        $data = [
            'tanggal'=>$request->tanggal,
            'nominal'=>$request->nominal,
            'ket_pengeluaran'=>$request->ket_pengeluaran,
        ];
        DanaKeluar::where('tanggal', $id)->update($data);
        return redirect()->to('dana_keluar')->with('success','Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DanaKeluar::where('tanggal', $id)->delete();
        return redirect()->to('dana_keluar')->with('success', 'Data berhasil dihapus');
    }

    /**
 * Prepare the data for validation.
 */
// protected function prepareForValidation(): void
// {
//     $this->merge([
//         'nominal' => str_replace('.', '', $this->nominal),
//     ]);
// }

        public function getTotalLast7Days()
        {
            // Mengambil tanggal dan waktu 7 hari yang lalu
            $date = Carbon::now()->subDays(7);

            // Menjumlahkan nominal dari database yang dibuat dalam 7 hari terakhir
            $total = DanaKeluar::where('tanggal', '>=', $date)->sum('nominal');

            // Mengirim data ke view
            return view('dana_keluar.total_last_7_days', ['total' => $total]);
        }

}
