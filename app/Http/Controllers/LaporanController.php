<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\laporan;
use App\Models\LaporanKeuangan;

class LaporanController extends Controller
{
    public function index(){
        $data = LaporanKeuangan::orderBy('tanggal', 'desc')->get();
        return view('home')->with('data', $data);
    }

}
