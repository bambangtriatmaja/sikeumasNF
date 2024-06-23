<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanaKeluar extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    protected $fillable = ['tanggal', 'nominal', 'ket_pengeluaran'];
    protected $table = 'dana_keluar';
}
