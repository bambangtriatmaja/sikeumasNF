<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = ['tanggal', 'infaq', 'pengeluaran', 'ket_pengeluaran', 'saldo_akhir'];
    protected $table = 'laporan_keuangan';
    // public $timestamps = false;
}
